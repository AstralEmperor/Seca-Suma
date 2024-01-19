<?php
//  Upravlja svim funkcijama koje rade sa podatcima iz DB KORISNIK
class DBKorisnik extends Tabela{
// Atributi
public $IDKorisnika;
public $Prezime;
public $Ime;
public $Email;
public $KorisnickoIme;
public $Sifra;

public $Stari_IDKorisnika;


public function UcitajSveKorisnike(){
    $SQL = "select * from korisnik";
    $this->UcitajSvePoUpitu($SQL);
}
    // nabavlja sve naloge iz data baze, i provarava da li zeljeni nalog postoji u DB
public function ProveraPostojanjaKorisnika($loginusername,$loginpassword){
    $postoji="";
    $SQLKorisnik = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`korisnik` WHERE
    KorisnickoIme='".$loginusername."' AND Sifra='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLKorisnik);

    if($this->BrojZapisa>0){
        $postoji="DA";
    }else{
        $postoji="NE";
    }
    return $postoji;

}
// Proverava trenutno ulogovanog korisnika i vraca $ime korisnika
public function PreuzmiImePrijavljenogKorisnika($loginusername,$loginpassword){
    $korisnik="";
    $SQLKorisnik = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`korisnik` WHERE
    KorisnickoIme='".$loginusername."' AND Sifra='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLKorisnik);
    $this->PrebaciKolekcijuUListu($this->Kolekcija);
    if($this->BrojZapisa>0){
        foreach($this->ListaZapisa as $VrednostCvoraListe){
            $ime=$VrednostCvoraListe[2];
        }
    }else{
        $ime='Nepoznat Korisnik';
    }
    return $ime;
}
// Proverava trenutno ulogovanog korisnika i vraca $prezime korisnika
public function PreuzmiPrezimePrijavljenogKorisnika($loginusername,$loginpassword){
    $korisnik="";
    $SQLKorisnik = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`korisnik` WHERE
    KorisnickoIme='".$loginusername."' AND Sifra='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLKorisnik);
    $this->PrebaciKolekcijuUListu($this->Kolekcija);
    if($this->BrojZapisa>0){
        foreach($this->ListaZapisa as $VrednostCvoraListe){
            $prez=$VrednostCvoraListe[1];
        }
    }else{
        $prez='Nepoznat Korisnik';
    }
    return $prez;
}
// Proverava trenutno ulogovanog korisnika i vraca $Ime i $prezime korisnika
public function PreuzmiImeIPrezimePrijavljenogKorisnika($loginusername,$loginpassword){
    $korisnik="";
    $SQLKorisnik = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`korisnik` WHERE
    KorisnickoIme='".$loginusername."' AND Sifra='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLKorisnik);
    $this->PrebaciKolekcijuUListu($this->Kolekcija);
    if($this->BrojZapisa>0){
        foreach($this->ListaZapisa as $VrednostCvoraListe){
            $prez=$VrednostCvoraListe[1];
            $ime=$VrednostCvoraListe[2];
            $korisnik=$prez.''.$ime;
        }
    }else{
        $korisnik='Nepoznat Korisnik';
    }
    return $korisnik;
}
// Proverava trenutno ulogovanog korisnika i vraca $IDKorisnika korisnika
public function PreuzmiIdPrijavljenogKorisnika($loginusername,$loginpassword){
    $id=0;
    $SQLKorisnik = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`korisnik` WHERE
    KorisnickoIme='".$loginusername."' AND Sifra='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLKorisnik);
    $this->PrebaciKolekcijuUListu($this->Kolekcija);
    if($this->BrojZapisa>0){
        foreach($this->ListaZapisa as $VrednostCvoraListe){
            $id=$VrednostCvoraListe[0];
        }
    }
    return $id;
  }
// Unos novog zapisa
public function SnimiNovo(){
    $AktivanSQLUpit="";
    $this->IzvrsiAktivanSQLUpit($AktivanSQLUpit);
} 
// Brisanje zapisa
public function Obrisi(){
    $AktivanSQLUpit="DELETE from";
    $this->IzvrsiAktivanSQLUpit($AktivanSQLUpit);
}
// Brisanje svih zapisa
public function ObrisiSve(){
    $AktivanSQLUpit="DELETE from";
    $this->IzvrsiAktivanSQLUpit($AktivanSQLUpit);
}
// izmena postojeceg zapisa
public function IzmeniVrednostPolja(){
    $AktivanSQLUpit = "UPDATE SET";
    $this->IzvrsiAktivanSQLUpit($AktivanSQLUpit);
}
}
?>