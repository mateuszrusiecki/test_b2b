<?php
/**
 * Rozwiazanie integracyjne Comarch ERP Optima <-> FEB B2B
 *
 * (C) 2015 Klim Baron Business Solutions Sp. z o.o. Wszelkie prawa zastrzezone.
 */

 
function generujRowid()
{
	return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
		mt_rand(0, 65535),
		mt_rand(0, 65535),
		mt_rand(0, 65535),
		mt_rand(16384, 20479),
		mt_rand(32768, 49151),
		mt_rand(0, 65535),
		mt_rand(0, 65535),
		mt_rand(0, 65535));
}

function dekodujRodzaj($typ, $dostawca, $odbiorca)
{
	if ($typ == 1 || $typ == 2)
		$typ = 0;

	if ($dostawca)       $rodzaj = 2;
	else if ($odbiorca)  $rodzaj = 1;
	else                 $rodzaj = $typ;

	return array($rodzaj, $dostawca, $odbiorca, $typ==3?1:0, $typ==4?1:0, $typ==5?1:0);
}

function numerGID($optima)
{
	$sql = "select isnull(max(Knt_GIDNumer),0) as MaxNumerNr from [CDN].[Kontrahenci]";
	$rows = $optima->query($sql);

	$max_numer = $rows[0]["MaxNumerNr"];
	return ++$max_numer;
}

function atrybutID($optima, $atrybut)
{
	$sql = "select DeA_DeAId from [CDN].[DefAtrybuty] where DeA_Typ = 2 and DeA_Kod = ?";
	$rows = $optima->query($sql, array($atrybut));
	return $rows[0]["DeA_DeAId"];
}

function kategoriaID($optima, $kategoria, $subkategoria)
{
	if (empty($kategoria) && empty($subkategoria))
		return null;

	$sql = "select Kat_KatID from [CDN].[Kategorie] where Kat_KodOgolny = ? and Kat_KodSzczegol = ?";
	$rows = $optima->query($sql, array($kategoria, $subkategoria));
	return $rows[0]["Kat_KatID"];
}

function cenaID($optima, $nazwaCeny)
{
	$sql = "select DfC_DfCId from [CDN].[DefCeny] where DfC_Nazwa = ?";
	$rows = $optima->query($sql, array($nazwaCeny));
	return $rows[0]["DfC_DfCId"];
}

function bankID($optima, $prefiksBanku)
{
	$sql = "select BNa_BNaId from [CDN].[BnkNazwy] where BNa_Numer = ?";
	$rows = $optima->query($sql, array($prefiksBanku));
	return $rows[0]["BNa_BNaId"];
}

// Optima przechowuje numery kont w formacie np. 38-20301459-1259632895621458
function podzielRachunek($rachunek)
{
	$suma = substr($rachunek, 0, 2);
	$bank = substr($rachunek, 2, 8);
	$klient = substr($rachunek, 10);
	return array($suma, $bank, $klient);
}

function normalizuj($numer)
{
	return str_replace(array("-", " "), "", $numer);
}

// ta funkcja jest wykonywana przez klienta za pośrednictwem interfejsu SOAP
// zwraca identyfikator dodanej krotki, jeśli wszystkie dane były prawidłowe
// i udało się utworzyć kontrahenta, albo wyjątek bezpośrednio z klienta SOAP
function dodajKontrahenta($typ, $dostawca, $odbiorca, $export, $platnik, $ceny, $grupa, $kod, $nazwa1, $nazwa2, $opis,
						  $kraj, $wojewodztwo, $kod_pocztowy, $miasto, $ulica, $nr_domu, $nr_lokalu, $nip, $nip_kraj_ue,
						  $telefon1, $telefon2, $email, $konto_bankowe, $projekt)
{
	global $optima;
	global $optima_sqlsrv_options;
	global $atrybut_numer_projektu;
	global $ksiegowosc_przychod;
	global $ksiegowosc_rozchod;
	global $domyslna_kategoria_sprzedazy;
	global $domyslna_kategoria_zakupu;

	$optima->begin();

	$id_atrybutu = atrybutID($optima, $atrybut_numer_projektu);
	$rodzaj = dekodujRodzaj($typ, $dostawca, $odbiorca);
	$czas = date("Y-m-d H:i:s");

	$konto = normalizuj($konto_bankowe);

	if (strlen($konto) == 26) {
		$iban = 1;
		$tmp = podzielRachunek($konto);
		$rachunek = $tmp[0]."-".$tmp[1]."-".$tmp[2];
		$id_banku = bankID($optima, $tmp[1]);
		$id_formy_platnosci = 3;
	} else {
		$iban = 0;
		$rachunek = "";
		$id_banku = null;
		$id_formy_platnosci = 1;
	}

	$kontrahent = array (
		"Knt_PodmiotTyp"                => 1,
		"Knt_Kod"                       => $kod,
		"Knt_Nazwa1"                    => $nazwa1, //nazwa kontrahenta
		"Knt_Nazwa2"                    => $nazwa2,
		"Knt_Nazwa3"                    => "",
		"Knt_Opis"                      => $opis,
		"Knt_GLN"                       => "",
		"Knt_EAN"                       => "",

		"Knt_NipKraj"                   => $nip_kraj_ue,
		"Knt_NipE"                      => $nip,
		"Knt_Nip"                       => normalizuj($nip),
		"Knt_Regon"                     => "",

		"Knt_Kraj"                      => $kraj,
		"Knt_KrajISO"                   => "",
		"Knt_Wojewodztwo"               => $wojewodztwo,
		"Knt_KodPocztowy"               => $kod_pocztowy,
		"Knt_Miasto"                    => $miasto,
		"Knt_Ulica"                     => $ulica,
		"Knt_NrDomu"                    => $nr_domu,
		"Knt_NrLokalu"                  => $nr_lokalu,
		"Knt_Adres2"                    => "",
		"Knt_Gmina"                     => "",
		"Knt_Poczta"                    => "",
		"Knt_Powiat"                    => "",
		"Knt_Telefon1"                  => $telefon1,
		"Knt_Telefon2"                  => $telefon2,
		"Knt_Fax"                       => "",
		"Knt_URL"                       => "",
		"Knt_Email"                     => $email,

		"Knt_OsKraj"                    => $kraj,
		"Knt_OsWojewodztwo"             => $wojewodztwo,
		"Knt_OsKodPocztowy"             => $kod_pocztowy,
		"Knt_OsMiasto"                  => $miasto,
		"Knt_OsUlica"                   => $ulica,
		"Knt_OsNrDomu"                  => $nr_domu,
		"Knt_OsNrLokalu"                => $nr_lokalu,
		"Knt_OsAdres2"                  => "",
		"Knt_OsGmina"                   => "",
		"Knt_OsPoczta"                  => "",
		"Knt_OsPowiat"                  => "",
		"Knt_OsPlec"                    => 1,
		"Knt_OsTytul"                   => "",
		"Knt_OsNazwisko"                => "",
		"Knt_Pesel"                     => "",
		"Knt_OsEmail"                   => "",
		"Knt_OsTelefon"                 => "",
		"Knt_OsGSM"                     => "",

		"Knt_BNaID"                     => $id_banku,
		"Knt_IBAN"                      => $iban,
		"Knt_RachunekNr"                => $rachunek,
		"Knt_FplID"                     => $id_formy_platnosci,  // domyślna forma płatności: 1-gotówka, 3-przelew
		"Knt_MaxZwloka"                 => 0,                    // ilość dni do przelewu, 0-przedpłata >0-przelew już po odebraniu towaru

		"Knt_Finalny"                   => 0,
		"Knt_Export"                    => $export, //???
		"Knt_Nieaktywny"                => 0,
		"Knt_Informacje"                => 0,
		"Knt_Upust"                     => 0,
		"Knt_LimitFlag"                 => 0,
		"Knt_LimitKredytu"              => 0,
		"Knt_Ceny"                      => cenaID($optima, $ceny),
		"Knt_TerminPlat"                => 0,
		"Knt_Termin"                    => 0,
		"Knt_KatID"                     => kategoriaID($optima, $domyslna_kategoria_sprzedazy[0], $domyslna_kategoria_sprzedazy[1]),
		"Knt_KatZakID"                  => kategoriaID($optima, $domyslna_kategoria_zakupu[0], $domyslna_kategoria_zakupu[1]),
		"Knt_BlokadaDok"                => 0,
		"Knt_LimitKredytuWal"           => "",
		"Knt_LimitKredytuWykorzystany"  => 0,
		"Knt_NieRozliczac"              => 0,
		"Knt_PodatekVat"                => $platnik,
		"Knt_Rodzaj"                    => $rodzaj[0],
		"Knt_Rodzaj_Dostawca"           => $rodzaj[1],
		"Knt_Rodzaj_Odbiorca"           => $rodzaj[2],
		"Knt_Rodzaj_Konkurencja"        => $rodzaj[3],
		"Knt_Rodzaj_Partner"            => $rodzaj[4],
		"Knt_Rodzaj_Potencjalny"        => $rodzaj[5],
		"Knt_Medialny"                  => 0,
		"Knt_MalyPod"                   => 0,
		"Knt_Rolnik"                    => 0,
		"Knt_Chroniony"                 => 0,
		"Knt_TerminZwrotuKaucji"        => 0,
		"Knt_NaliczajPlatnosc"          => 0,
		"Knt_ZakazDokumentowHaMag"      => 0,
		"Knt_ImportRowId"               => generujRowid(),
		"Knt_OpeZalID"                  => 1,  // numer operatora z bazy konfiguracyjnej (można to zaimplementować na potrzeby np. zgodności z jakąś normą bezpieczeństwa)
		"Knt_OpeModID"                  => 1,  // numer operatora z bazy konfiguracyjnej (można to zaimplementować na potrzeby np. zgodności z jakąś normą bezpieczeństwa)
		"Knt_StaZalId"                  => 1,  // numer stanowiska z bazy konfiguracyjnej (można to zaimplementować na potrzeby np. zgodności z jakąś normą bezpieczeństwa)
		"Knt_StaModId"                  => 1,  // numer stanowiska z bazy konfiguracyjnej (można to zaimplementować na potrzeby np. zgodności z jakąś normą bezpieczeństwa)
		"Knt_TS_Zal"                    => $czas,
		"Knt_TS_Mod"                    => $czas,
		"Knt_GIDTyp"                    => 0,
		"Knt_GIDFirma"                  => 0,
		"Knt_GIDNumer"                  => numerGID($optima),
		"Knt_GIDLp"                     => 0,
		"Knt_LimitPrzeterKredytFlag"    => 0,
		"Knt_LimitPrzeterKredytWartosc" => 0,
		"Knt_ZgodaNaEFaktury"           => 0,
		"Knt_OpiekunKsiegDomyslny"      => 1,
		"Knt_OpiekunPiKDomyslny"        => 1,
		"Knt_Grupa"                     => $grupa,
		"Knt_KodTransakcji"             => "",   // kod transakcji dla INTRASTAT (dot. transakcji międzynarodowych w ramach UE, w razie potrzeby można zaimplementować)
		"Knt_KontoDost"                 => $ksiegowosc_przychod,
		"Knt_KontoOdb"                  => $ksiegowosc_rozchod,
		"Knt_Zezwolenie"                => "",
		"Knt_FCzynnosci"                => 1,
		"Knt_FCzesci"                   => 0,
		"Knt_ZwolnionyZAkcyzy"          => 0,
		"Knt_PowiazanyUoV"              => 0,
		"Knt_NieNaliczajOdsetek"        => 0,
		"Knt_ESklep"                    => 0,
		"Knt_WindykacjaEMail"           => "",
		"Knt_TelefonSms"                => "",
		"Knt_WindykacjaTelefonSms"      => "",
		"Knt_MetodaKasowa"              => 0,
		"Knt_FinalnyWegiel"             => 0,
		"Knt_Komornik"                  => 0,
	);

	$last_id = $optima->insert("[CDN].[Kontrahenci]", $kontrahent);

	$atrybut = array (
		"KnA_DeAId"             => $id_atrybutu,
		"KnA_PodmiotTyp"        => 1,
		"KnA_PodmiotId"         => $last_id,
		"KnA_WartoscTxt"        => "$projekt.0000",
		"KnA_CzyKopiowac"       => 0,
		"KnA_CzyKod"            => 0,
		"KnA_CzyPrzenosic"      => 1,
		"KnA_CzyDrukowac"       => 0,
		"KnA_CzyKopiowacDoVAT"  => 0,
	);

	$optima->insert("[CDN].[KntAtrybuty]", $atrybut);

	$schemat = array (
		"SPL_PodmiotId"         => $last_id,
		"SPL_PodmiotTyp"        => 1,
		"SPl_OdbPodmiotID"      => $last_id,
		"SPl_OdbPodmiotTyp"     => 1,

		"SPL_FplId"             => $id_formy_platnosci,
		"SPL_BnaId"             => $id_banku,
		"SPL_RachunekNr"        => $rachunek,
		"SPL_IBAN"              => $iban,
		"SPL_LiczbaPorz"        => 1,
		"SPL_Reszta"            => 1,
		"SPL_Opis"              => "",

		"SPL_Rodzaj"            => 0,
		"SPL_Kwota"             => 0,
		"SPL_Procent"           => 100,

		"SPL_OpeZalID"          => 1,  // numer operatora z bazy konfiguracyjnej (można to zaimplementować na potrzeby np. zgodności z jakąś normą bezpieczeństwa)
		"SPL_OpeModID"          => 1,  // numer operatora z bazy konfiguracyjnej (można to zaimplementować na potrzeby np. zgodności z jakąś normą bezpieczeństwa)
		"SPL_StaZalId"          => 1,  // numer stanowiska z bazy konfiguracyjnej (można to zaimplementować na potrzeby np. zgodności z jakąś normą bezpieczeństwa)
		"SPL_StaModId"          => 1,  // numer stanowiska z bazy konfiguracyjnej (można to zaimplementować na potrzeby np. zgodności z jakąś normą bezpieczeństwa)
		"SPL_TS_Zal"            => $czas,
		"SPL_TS_Mod"            => $czas,
	);

	$optima->insert("[CDN].[SchematPlatnosci]", $schemat);
	$optima->commit();
	return $last_id;
}
