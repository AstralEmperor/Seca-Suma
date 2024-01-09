<?php

class Konekcija{

public $konekcijaMYSQL;
public $konekcijaDB;
public $kompletanNazivBazePodataka;
public $VerzijaMYSQL;

private $PutanjaNazivFajlaXMLParametriKonekcije;
private $korisnik;
private $sifra;
private $host;
private $prefiks_baze_podataka;
private $naziv_baze_podataka;

private function UcitajVerzijuMYSQL(){
    $VerzijaPHP = phpversion();

    if($VerzijaPHP<'7.0.0'){
        $this->$VerzijaMYSQL="mysql";
    }else {
        $this->$VerzijaMYSQL="mysqli";
    }
}

private function UcitajParamKonekcije($PutanjaNazivFajlaXMLParametriKonekcije){
    $xml=simplexml_load_file($PutanjaNazivFajlaXMLParametriKonekcije) or die("Greska: ne postoji fajl BaznaParametrikonekcije.xml");
    
    $this->host=$xml->host;
    $this->korisnik=$xml->korisnik;
    $this->sifra=$xml->sifra;

    $this->$prefiks_baze_podataka = $xml->prefiks_baze_podataka;
    $this->$naziv_baze_podataka = $xml->naziv_baze_podataka;
    $this->$kompletanNazivBazePodataka=$this->prefiks_baze_podataka.$this->naziv_baze_podataka;
}

public function __constructor($NovaPutanjaNazivFajlaXMLParametriKonekcije){
    $this->$PutanjaNazivFajlaXMLParametriKonekcije=$NovaPutanjaNazivFajlaXMLParametriKonekcije;
    $this->UcitajVerzijuMYSQL();
    $this->UcitajParamKonekcije($NovaPutanjaNazivFajlaXMLParametriKonekcije);
}

public function connect(){
    if($this->$VerzijaMYSQL=="mysqli"){
        $this->konekcijaDB = mysqli_connect($this->host, $this->korisnik, $this->sifra, $this->$kompletanNazivBazePodataka);
    }else{
        $this->konekcijaMYSQL = mysql_connect($this->host, $this->korisnik, $this->sifra);
        $this->konekcijaDB = mysql_select_db($this->$kompletanNazivBazePodataka, $this->konekcijaMYSQL);
    }
 if($this->konekcijaDB){
    if($this->$VerzijaMYSQL=="mysqli"){
        mysqli_set_charset($this->konekcijaDB,"utf8");
    }
    else{
        mysql_query('SET NAMES "utf8"',$this->konekcijaMYSQL);
    }
  }
 }

 public function disconnect(){
    if($this->$VerzijaMYSQL=="mysqli"){
        mysqli_close($this->konekcijaDB);
    }
    else{
        mysql_close($this->konekcijaMYSQL);
    }
 }
}
?>