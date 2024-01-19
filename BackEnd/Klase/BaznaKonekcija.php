<?php
// Klasa za realizaciju konekcije sa DB
class Konekcija{

public $konekcijaMYSQL;
public $konekcijaDB;
public $KompletanNazivBazePodataka;
public $VerzijaMySQLNaredbi;

private $PutanjaNazivFajlaXMLParametriKonekcije;
private $korisnik;
private $sifra;
private $host;
private $prefiks_baze_podataka;
private $naziv_baze_podataka;

// Proverava trenutnu verziju php
private function UcitajVerzijuMYSQLNaredbi(){
    $VerzijaPHP = phpversion();
    if($VerzijaPHP<'7.0.0'){
        $this->VerzijaMySQLNaredbi="mysql";
    }else {
        $this->VerzijaMySQLNaredbi="mysqli";
    }
}

// ucitava parametre konekcije na server i data bazu
private function UcitajParamKonekcije($PutanjaNazivFajlaXMLParametriKonekcije){
    $xml=simplexml_load_file($PutanjaNazivFajlaXMLParametriKonekcije) or die("Greska: ne postoji fajl BazniParamKonekcije.xml");
    
    $this->host=$xml->host;
    $this->korisnik=$xml->korisnik;
    $this->sifra=$xml->sifra;

    $this->prefiks_baze_podataka = $xml->prefiks_baze_podataka;
    $this->naziv_baze_podataka = $xml->naziv_baze_podataka;
    $this->KompletanNazivBazePodataka = $this->prefiks_baze_podataka.$this->naziv_baze_podataka;
}
// konstruktor klase
public function __construct($NovaPutanjaNazivFajlaXMLParametriKonekcije){
    $this->PutanjaNazivFajlaXMLParametriKonekcije=$NovaPutanjaNazivFajlaXMLParametriKonekcije;
    $this->UcitajVerzijuMYSQLNaredbi();
    $this->UcitajParamKonekcije($NovaPutanjaNazivFajlaXMLParametriKonekcije);
}

// funkcija za konekciju na SQL, i proverava da li je konekcija moguca kao i da li je korisnik ulogovan
public function connect(){
    if($this->VerzijaMySQLNaredbi=="mysqli"){
        $this->konekcijaDB = mysqli_connect($this->host, $this->korisnik, $this->sifra, $this->KompletanNazivBazePodataka);
    }else{
        $this->konekcijaMYSQL = mysql_connect($this->host, $this->korisnik, $this->sifra);
        $this->konekcijaDB = mysql_select_db($this->KompletanNazivBazePodataka, $this->konekcijaMYSQL);
    }
 if($this->konekcijaDB){
    if($this->VerzijaMySQLNaredbi=="mysqli"){
        mysqli_set_charset($this->konekcijaDB,"utf8");
    }
    else{
        mysql_query('SET NAMES "utf8"',$this->konekcijaMYSQL);
    }
  }
 }
// funkcija za diskonekciju sa servera
 public function disconnect(){
    if($this->VerzijaMySQLNaredbi=="mysqli"){
        mysqli_close($this->konekcijaDB);
    }
    else{
        mysql_close($this->konekcijaMYSQL);
    }
 }
}
?>