select
	tranag.TrN_NumerPelny as numer_faktury,
	nabywcy.Knt_Kod as kod_kontrahenta,
	odbiorcy.Knt_Kod as kod_odbiorcy,
	tranag.TrN_PodID as id_kontrahenta,
	tranag.TrN_OdbID as id_odbiorcy,
	tranag.TrN_DataDok as data_dokumentu,
	tranag.TrN_Termin as termin_platnosci,
	traelem.TrE_WartoscBruttoWal as wartosc_brutto,
	traelem.TrE_Waluta as waluta,
	traelem.TrE_TwrId as id_towaru,
	substring(traelem.TrE_TwrNazwa, 0, 201) as nazwa_towaru,
	cast (traelem.TrE_Ilosc as decimal(9,3)) as ilosc,
	formy.FPl_Nazwa as forma_platnosci,
	rachunki.BRa_Nazwa as bank_nazwa,
	replace(rachunki.BRa_RachunekNr, '-', '') as bank_rachunek,
	tranag.TrN_Opis as opis_faktury,
	(
		select convert(int, atr.DAt_WartoscDecimal)
		from [CDN].[DokAtrybuty] atr
		where atr.DAt_TrNId = tranag.TrN_TrNID
		and atr.DAt_Kod = '{atrybut}'
	) as atrybut_projekt,
	(
		select top 1
		case when traelem.TrE_WartoscBruttoWal  <=  bz.BZd_KwotaSys - bz.BZd_KwotaRozSys
			 then traelem.TrE_WartoscBruttoWal else bz.BZd_KwotaSys - bz.BZd_KwotaRozSys end
		from [CDN].[BnkZdarzenia] bz
		where bz.BZd_DokumentID = tranag.TrN_TrNID
		and bz.BZd_DokumentTyp = 1
	) as pozostalo_do_zaplaty

from
	[CDN].[TraNag] tranag,
	[CDN].[TraElem] traelem,
	[CDN].[FormyPlatnosci] formy,
	[CDN].[BnkRachunki] rachunki,
	[CDN].[Kontrahenci] nabywcy,
	[CDN].[Kontrahenci] odbiorcy

where traelem.TrE_TrNId = tranag.TrN_TrNID
and traelem.TrE_TypDokumentu = {klasafa}
and tranag.TrN_TypDokumentu = {klasafa}
and tranag.TrN_DataDok between '{od}' and '{do}'
and tranag.TrN_Bufor = 0
and tranag.TrN_PodID = nabywcy.Knt_KntId
and tranag.TrN_OdbID = odbiorcy.Knt_KntId
and tranag.TrN_FPlId = formy.FPl_FPlId
and rachunki.BRa_BRaID = formy.FPl_BRaId
