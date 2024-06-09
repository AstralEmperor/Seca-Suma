<?php
//  Upravlja svim funkcijama koje rade sa podatcima iz DB POVRSINA, nasledjuje klasu TABELA
class DBPovrsina extends Tabela
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;

public $povrsinaID;
public $povrsinaZaSecu;
public $ukupnaPovrsina;
public $mladice;
public $praznina;

// Ucitava kolekciju svih povrsina u odnosu na ukupnu kolicinu troska
    public function UcitajKolekcijuSvihPovrsina()
    {
        $SQL = "select * from `POVRSINA` ORDER BY ukupnaPovrsina ASC";
        $this->UcitajSvePoUpitu($SQL);    
    }
        // Vraca filtriranu kolekciju povrsina
    public function DajSvePodatkeOPovrsiniZaSecu($filterParametar){
        if(isset($filterParametar)){
            $upit="select * from `".$this->NazivBazePodataka."`.`POVRSINA` where `povrsinaZaSecu`='".$filterParametar."'";
        }else{
            $upit="select * from `".$this->NazivBazePodataka."`.`POVRSINA`";
        }
        $this->UcitajSvePoUpitu($upit);
    }
    public function UcitajSecuPoId($povrsinaID)
    {
        $SQL = "select * from `POVRSINA` WHERE `povrsinaID`='".$povrsinaID."'";
        $this->UcitajSvePoUpitu($SQL);
    }
    // funkcija dodavanja novih povrsina preuzimanjem odgovarajucih inputa
    public function DodajNovuPovrsinu()
    {
        $SQL = "INSERT INTO `SUME`.`POVRSINA` (povrsinaZaSecu, ukupnaPovrsina, mladice, praznina)
        VALUES ('$this->povrsinaZaSecu','$this->ukupnaPovrsina','$this->mladice','$this->praznina')";

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
// Brise povrsinu
    public function ObrisiPovrsinu($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `POVRSINA` WHERE povrsinaID=".$IdZaBrisanje;
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
// Menja povrsinu
    public function IzmeniPovrsinu($StaraPovrsinaID, $PovrsinaId, $PovrsinaZaSecu, $UkupnaPovrsina, $Mladice, $Praznina)
    {
        $SQL = "UPDATE `POVRSINA` SET povrsinaID ='".$povrsinaID."', 
        povrsinaZaSecu='".$PovrsinaZaSecu."', ukupnaPovrsina='".$UkupnaPovrsina."', mladice='".$Mladice."', praznina='".$Praznina."'
        WHERE povrsinaID ='".$StaraPovrsinaID."'";
        
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

}
?>