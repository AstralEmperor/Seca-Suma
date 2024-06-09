<?php
//  Upravlja svim funkcijama koje rade sa podatcima iz DB ZAKAZANASECA, nasledjuje klasu TABELA
class DBZakazaneSece extends Tabela 
{
    private $bazapodataka;
    private $UspehKonekcijeNaDBMS;
    //
    public $SecaID;
    public $VrstaDrveta;
    public $PovrsinaSumeID;
    public $Datum;
    public $Neto;
    public $TrosakPriRaduID;
    public $Mesto;
    public $PlacenoUnapred;

    // ucitava sve zakazane sece sortirane po vrsti drveta
    public function DajKolekcijuSvihZakazanihSeca()
    {
        $SQL = "select * from `ZAKAZANASECA` ORDER BY VrstaDrveta ASC";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    

    public function DajSvePodatkeOZakazanimSecama($filterParametar){
        if(isset($filterParametar)){
            $upit="select * from `".$this->NazivBazePodataka."`.`ZAKAZANASECA` where `VrstaDrveta`='".$filterParametar."'";
        }else{
            $upit="select * from `".$this->NazivBazePodataka."`.`ZAKAZANASECA`";
        }
        $this->UcitajSvePoUpitu($upit);
    }

    // ucitava sve sece po vrsti drveta
    public function UcitajSecuPoId($SecaIDParametar)
    {
        $SQL = "select * from `ZAKAZANASECA` WHERE `SecaID`='".$SecaIDParametar."'";
        $this->UcitajSvePoUpitu($SQL);
    }
    // funkcija dodavanje nove sece preuzimanjem odgovarajucih inputa
    public function DodajNovuSecu()
    {
        $SQL = "INSERT INTO `SUME`.`ZAKAZANASECA` (VrstaDrveta, PovrsinaSumeID, Datum, Neto, TrosakPriRaduID, Mesto, PlacenoUnapred)
        VALUES ('$this->VrstaDrveta', '$this->PovrsinaSumeID','$this->Datum','$this->Neto','$this->TrosakPriRaduID','$this->Mesto', '$this->PlacenoUnapred')";

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
    // Brise izabranu zakazanu secu gde je ID $idzabrisanje
    public function ObrisiZakazanuSecu($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `ZAKAZANASECA` WHERE SecaID='".$IdZaBrisanje."'";
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);
        return $greska;
    }
    // Izmenjuje izabranu zakazanu secu novo unetim podatcima
    public function IzmeniZakazanuSecu($StariSecaID, $SecaID, $VrstaDrveta, $PovrsinaSumeID, $Datum, $Neto, $TrosakPriRaduID, $Mesto, $PlacenoUnapred)
    {
        $SQL = "UPDATE `ZAKAZANASECA` SET SecaID='".$SecaID."', 
        VrstaDrveta='".$VrstaDrveta."', PovrsinaSumeID='".$PovrsinaSumeID."', Datum='".$Datum."', Neto='".$Neto."', TrosakPriRaduID='".$TrosakPriRaduID."' ,
        Mesto='".$Mesto."',PlacenoUnapred='".$PlacenoUnapred."'
        WHERE SecaID='".$StariSecaID."'";
        
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
}
?>