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
    public $Mesto;
    public $Trosak;

    public function DajKolekcijuSvihZakazanihSeca()
    {
        $SQL = "select * from `ZAKAZANASECA` ORDER BY VrstaDrveta ASC";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }

    public function UcitajSecePoNazivuDrveta($VrstaDrvetaParametar)
    {
        $SQL = "select * from `ZAKAZANASECA` WHERE `VrstaDrveta`='".$VrstaDrvetaParametar."'";
        $this->UcitajSvePoUpitu($SQL);
    }

    public function DodajNoveSece()
    {
        $SQL = "INSERT INTO `ZAKAZANASECA` (VrstaDrveta, PovrsinaSume, Datum, Neto, Mesto, Trosak)
        VALUES ('$this->VrstaDrveta', '$this->PovrsinaSume','$this->Datum','$this->Neto','$this->Mesto', '$this->Trosak')";

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function ObrisiZakazanuSecu($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `ZAKAZANASECA` WHERE DoprinosID='.$IdZaBrisanje.'";
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);
        return $greska;
    }

    public function IzmeniZakazanuSecu($StariDoprinosID, $DoprinosID, $VrstaDrveta, $PovrsinaSume, $Datum, $Neto, $Mesto, $Trosak)
    {
        $SQL = "UPDATE `ZAKAZANASECA` SET VrstaDrveta='".$VrstaDrveta."', PovrsinaSume=".$PovrsinaSume.", Datum='".$Datum."', Neto=".$Neto.", Mesto='".$Mesto."', Trosak=".$Trosak."
        WHERE DoprinosID='.$StariDoprinosID.'";
        
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
}
?>