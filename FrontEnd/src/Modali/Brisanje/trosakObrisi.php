<?php
// proverava da li je korisnik prijavljen
session_start();
$korisnik=$_SESSION["korisnik"];

    if(!isset($korisnik)){
        header('Location:/Seca-Suma/index.php');
    }

    $trosakID=$_POST['trosakID'];

    // uzima ID i brise ceo objekat iz data baze
    $IdZaBrisanje=$_POST['trosakID'];

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

    // ostvaruje se konekcija 
   $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml");
   $KonekcijaObject->connect();

   if($KonekcijaObject->konekcijaDB){
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBTrosak.php";
    $TrosakObject = new DBTrosak($KonekcijaObject, 'trosak');

    $greska=$TrosakObject->ObrisiTrosak($IdZaBrisanje);
   }
   $KonekcijaObject->disconnect();
   
   header('Location:/SECA-SUMA/FrontEnd/src/Stranice/Trosak/trosakAdmin.php');
?>