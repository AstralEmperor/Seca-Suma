<?php
class DBZakazaneSece extends Tabela 
{
    private $bazapodataka;
    private $UspehKonekcijeNaDBMS;
    //
    public $DoprinosID;
    public $VrstaDrveta;
    public $PovrsinaSume;
    public $Datum;
    public $Neto;
    public $Trosak;
    public $Mesto;
    public $PlacenoUnapred;

    // ucitava sve zakazane sece sortirane po vrsti drveta
    public function DajKolekcijuSvihZakazanihSeca()
    {
        $SQL = "select * from `ZAKAZANASECA` ORDER BY VrstaDrveta ASC";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    // ucitava sve sece vrsti drveta
    public function UcitajSecePoVrstiDrveta($VrstaDrvetaParametar)
    {
        $SQL = "select * from `ZAKAZANASECA` WHERE `VrstaDrveta`='".$VrstaDrvetaParametar."'";
        $this->UcitajSvePoUpitu($SQL);
    }

    public function DodajNovuSecu()
    {
        $SQL = "INSERT INTO `SUME`.`ZAKAZANASECA` (VrstaDrveta, PovrsinaSume, Datum, Neto, Trosak, Mesto, PlacenoUnapred)
        VALUES ('$this->VrstaDrveta', '$this->PovrsinaSume','$this->Datum','$this->Neto','$this->Trosak','$this->Mesto', '$this->PlacenoUnapred')";

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function ObrisiZakazanuSecu($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `ZAKAZANASECA` WHERE DoprinosID='".$IdZaBrisanje."'";
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);
        return $greska;
    }

    public function IzmeniZakazanuSecu($StariDoprinosID, $DoprinosID, $VrstaDrveta, $PovrsinaSume, $Datum, $Neto, $Trosak, $Mesto, $PlacenoUnapred)
    {
        $SQL = "UPDATE `ZAKAZANASECA` SET VrstaDrveta='".$VrstaDrveta."', PovrsinaSume=".$PovrsinaSume.", Datum='".$Datum."', Neto=".$Neto.", Trosak=".$Trosak." ,Mesto='".$Mesto."',PlacenoUnapred=".$PlacenoUnapred."
        WHERE DoprinosID='.$StariDoprinosID.'";
        
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
}
?>