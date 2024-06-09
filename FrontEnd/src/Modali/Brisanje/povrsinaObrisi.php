<?php
// proverava da li je korisnik prijavljen
session_start();
$korisnik=$_SESSION["korisnik"];

    if(!isset($korisnik)){
        header('Location:/Seca-Suma/index.php');
    }

    // uzima ID i brise ceo objekat iz data baze
    $IdZaBrisanje=$_POST['povrsinaID'];

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

    // ostvaruje se konekcija 
   $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml");
   $KonekcijaObject->connect();

   if($KonekcijaObject->konekcijaDB){
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBPovrsina.php";
    $PovrsinaObject = new DBPovrsina($KonekcijaObject, 'povrsina');

    $greska=$PovrsinaObject->ObrisiPovrsinu($IdZaBrisanje);
   }
   $KonekcijaObject->disconnect();
   
   header('Location:/SECA-SUMA/FrontEnd/src/Stranice/Povrsina/povrsinaAdmin.php');
?>