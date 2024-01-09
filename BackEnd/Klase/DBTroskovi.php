<?php

class DBTroskovi extends Tabela
{
    private $bazapodataka;
    private $UspehKonekcijeNaDBMS;
    //
    public $NazivDrveta;
    public $UkupanTrosak;

    public function DajKolekcijuSvihTroskova()
    {
        $SQL = "select * from `TROSKOVI` ORDER BY NazivDrveta ASC";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }

    public function UcitajTrosakPoNazivuDrveta($NazivDrvetaParametar)
    {
        $SQL = "select * from `TROSKOVI` WHERE `NazivDrveta`='".$NazivDrvetaParametar."'";
        $this->UcitajSvePoUpitu($SQL);
    }

    public function DodajNoveTroskove()
    {
        $SQL = "INSERT INTO `TROSKOVI` (NazivDrveta, UkupanTrosak)
        VALUES ('$this->NazivDrveta', '$this->UkupanTrosak')";

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function ObrisiTrosak($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `TROSKOVI` WHERE NazivDrveta='".$IdZaBrisanje"'";
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);
    }

    public function IzmeniTrosak($StariUkupanTrosak, $NazivDrveta, $UkupanTrosak)
    {
        $SQL = "UPDATE `TROSKOVI` SET NazivDrveta='".$NazivDrveta."', UkupanTrosak=".$UkupanTrosak."
        WHERE UkupanTrosak='".$StariUkupanTrosak."'";
        
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
}
?>