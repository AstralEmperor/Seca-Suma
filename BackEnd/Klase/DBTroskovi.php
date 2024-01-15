<?php

class DBTroskovi extends Tabela
{
    // ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $NazivDrveta;
public $UkupanTrosak;

    public function UcitajKolekcijaSvihTroskova()
    {
        $SQL = "select * from `TROSKOVI` ORDER BY Datum ASC";
        $this->UcitajSvePoUpitu($SQL);    
    }

    public function InkrementirajBrojTroskova($UkupanTrosak)
    {
        $KriterijumFiltriranja = "UkupanTrosak ='".$UkupanTrosak."'";
        $StaraVrednostUkBrTroskova = $this-> DajVrednostJednogPoljaPrvogZapisa ('UkupanTrosak', $KriterijumFiltriranja, 'UkupanTrosak');

        $NovaVrednostUkBrTroskova = $StaraVrednostUkBrTroskova + 1;

        $SQL = "UPDATE `".$this->NazivBazePodataka"`.`TROSKOVI` SET UkupanTrosak=".$NovaVrednostUkBrTroskova"
        WHERE UkupanTrosak ='".$UkupanTrosak"'";
          $greska= $this->IzvrsiAktivanUpit($SQL);

          return $greska;
    }
    
    public function DajKolekcijuTroskovaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
    {
        if($nacinFiltriranja == "like"){
            $SQL = "select * from * `TROSKOVI` WHERE $filterPolje like `%".$filterVrednost."%' ORDER BY $Sortiranje";
        }
        else{
            $SQL = "select * from `TROSKOVI` WHERE $filterPolje = '".$filterVrednost."' ORDER BY $Sortiranje";
        }
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    
    public function DodajNoviTrosak(){
        $SQL = "INSERT INTO `TROSKOVI` (NazivDrveta, UkupanTrosak)
        VALUES ('$this->NazivDrveta', '$this->UkupanTrosak')";

        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function ObrisiTrosak($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `TROSKOVI` WHERE ID=".$IdZaBrisanje;
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function IzmeniTrosak($NoviNazivDrveta, $NoviUkupanTrosak)
    {
        $SQL = "UPDATE `TROSKOVI` SET NazivDrveta='".$NoviNazivDrveta."',
        UkupanTrosak = ".$NoviUkupanTrosak." WHERE ID=".$IdZaIzmenu;

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

}
?>