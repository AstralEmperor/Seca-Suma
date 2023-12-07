<?php

class DBTroskovi extends Tabela
{
    private $bazapodataka;
    private $UspehKonekcijeNaDBMS;
    //
    public $NazivDrveta;
    public $VrstaRada;
    public $Cena;

    public function DajKolekcijuSvihTroskova()
    {
        $SQL = "select * from `TROSKOVI` ORDER BY VrstaRada ASC";
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
        $SQL = "INSERT INTO `TROSKOVI` (NazivDrveta, VrstaRada, Cena)
        VALUES ('$this->NazivDrveta', '$this->VrstaRada', '$this->Cena')";

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function ObrisiTrosak($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `TROSKOVI` WHERE NazivDrveta='".$IdZaBrisanje"'";
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);
    }

    public function IzmeniTrosak($StariNazivDrveta, $NazivDrveta, $VrstaRada, $Cena)
    {
        $SQL = "UPDATE `TROSKOVI` SET NazivDrveta='".$NazivDrveta."',VrstaRada='".$VrstaRada."', Cena=".$Cena."
        WHERE NazivDrveta='".$StariNazivDrveta."'";
        
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
}
?>