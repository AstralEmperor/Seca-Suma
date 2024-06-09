<?php
//  Upravlja svim funkcijama koje rade sa podatcima iz DB TROSAK, nasledjuje klasu TABELA
class DBTrosak extends Tabela
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;

public $trosakID;
public $ukupanTrosak;
public $plate;
public $prevozniTrosak;
public $masineTrosak;

// Ucitava kolekciju svih troskova u odnosu na ukupnu kolicinu troska
    public function UcitajKolekcijuSvihTroskova()
    {
        $SQL = "select * from `TROSAK` ORDER BY ukupanTrosak ASC";
        $this->UcitajSvePoUpitu($SQL);    
    }
        // Vraca filtriranu kolekciju troskova
    public function DajSvePodatkeOTroskovima($filterParametar){
        if(isset($filterParametar)){
            $upit="select * from `".$this->NazivBazePodataka."`.`TROSAK` where `trosakID`='".$filterParametar."'";
        }else{
            $upit="select * from `".$this->NazivBazePodataka."`.`TROSAK`";
        }
        $this->UcitajSvePoUpitu($upit);
    }
    public function UcitajSecuPoId($trosakID)
    {
        $SQL = "select * from `TROSAK` WHERE `trosakID`='".$trosakID."'";
        $this->UcitajSvePoUpitu($SQL);
    }

        // funkcija dodavanja novih troskova preuzimanjem odgovarajucih inputa
        public function DodajNoviTrosak()
        {
            $SQL = "INSERT INTO `SUME`.`TROSAK` (ukupanTrosak, plate, prevozniTrosak, masineTrosak)
            VALUES ('$this->ukupanTrosak','$this->plate','$this->prevozniTrosak','$this->masineTrosak')";
    
            $greska=$this->IzvrsiAktivanSQLUpit($SQL);
    
            return $greska;
        }
// Brise trosak
    public function ObrisiTrosak($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `TROSAK` WHERE trosakID=".$IdZaBrisanje;
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function IzmeniTrosak($StariTrosakID, $TrosakId, $UkupanTrosak, $Plata, $PrevozniTrosak, $MasineTrosak)
    {
        $SQL = "UPDATE `TROSAK` SET trosakID ='".$TrosakId."', 
        ukupanTrosak='".$UkupanTrosak."', plate='".$Plata."', prevozniTrosak='".$PrevozniTrosak."', masineTrosak='".$MasineTrosak."'
        WHERE trosakID ='".$StariTrosakID."'";
        
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

}
?>