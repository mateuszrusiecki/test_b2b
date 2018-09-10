<?php
/**
 * Rozwiazanie integracyjne Comarch ERP Optima <-> FEB B2B
 * 
 * Klasa korzysta z klasy Optima która łączy się z bazą commarcha i wykonuje odpowiednie zapywania(z folderu sql)
 *
 * (C) 2015 Klim Baron Business Solutions Sp. z o.o. Wszelkie prawa zastrzezone.
 */

require_once dirname(__FILE__)."/includes/optima.php";

class Select{
    
    private $optima;
    
	public function __construct()
	{
		if(empty($this->optima)) {
            $this->optima = new Optima();
            $this->optima->connect();
        }
	}

    function pobierzKodyKontrahentow($projekt)
    {
        global $atrybut_numer_projektu;

        $sql = $this->optima->loadSql("kody.sql", array(
            "atrybut" => $atrybut_numer_projektu,
        ));
        $rows = $this->optima->query($sql, array());
        $out = array();

        foreach ($rows as $row)
            if (empty($projekt) || (int)$row["atrybut_projekt"] == $projekt)
                $out[] = $row{"kod"};

        return $out;
    }
    
    function pobierzWszystkichKontrahentow()
    {
        global $atrybut_numer_projektu;

        $sql = $this->optima->loadSql("kontrahent.sql", array(
            "atrybut" => $atrybut_numer_projektu,
        ));
        $rows = $this->optima->query($sql, array());
        return empty($rows) ? false : $rows[0];
    }

    function pobierzKontrahenta($kod)
    {
        
        global $atrybut_numer_projektu;

        $sql = $this->optima->loadSql("kontrahent.sql", array(
            "kod" => $kod,
            "atrybut" => $atrybut_numer_projektu,
        ));
        $rows = $this->optima->query($sql, array());
        return empty($rows) ? false : $rows[0];
    }

    function pobierzFaktury($dataOd, $dataDo, $projekt, $klasa_faktury)
    {
        
        global $atrybut_numer_projektu;

        $sql = $this->optima->loadSql("faktury.sql", array(
            "od" => $dataOd,
            "do" => $dataDo,
            "atrybut" => $atrybut_numer_projektu,
            "klasafa" => $klasa_faktury,
        ));
        $rows = $this->optima->query($sql, array());

        if (empty($projekt))
            return $rows;

        $out = array();

        foreach ($rows as $row)
            if ((int)$row["atrybut_projekt"] == $projekt)
                $out[] = $row;

        return $out;
    }

    function pobierzFakturySprzedazy($dataOd, $dataDo, $projekt)
    {
        return pobierzFaktury($dataOd, $dataDo, $projekt, 302);
    }

    function pobierzFakturyZakupu($dataOd, $dataDo, $projekt)
    {
        return pobierzFaktury($dataOd, $dataDo, $projekt, 301);
    }

}