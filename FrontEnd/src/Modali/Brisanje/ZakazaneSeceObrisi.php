<?php
// proverava da li je korisnik prijavljen
session_start();
$korisnik=$_SESSION["korisnik"];

    if(!isset($korisnik)){
        header('Location:/Seca-Suma/index.php');
    }

    $Mesto=$_POST['mesto'];

    // uzima ID i brise ceo objekat iz data baze
    $IdZaBrisanje=$_POST['DoprinosID'];

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

    // ostvaruje se konekcija 
   $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml");
   $KonekcijaObject->connect();

   if($KonekcijaObject->konekcijaDB){
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSece.php";
    $ZakazaneSeceObject = new DBZakazaneSece($KonekcijaObject, 'zakazanaseca');

     // dekrementacija broja seca kroz klasu Mesto
     echo $Mesto;
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBMesta.php";;
    $MestoObject = new DBMesto($KonekcijaObject, 'mesto');
    $greska2=$MestoObject->DekrementirajUkupanBrojSecaPoMestu($Mesto);

    $greska=$ZakazaneSeceObject->ObrisiZakazanuSecu($IdZaBrisanje);
   }
   $KonekcijaObject->disconnect();
   
   header('Location:/SECA-SUMA/FrontEnd/src/Stranice/ZakazaneSece/zakazaneSeceAdmin.php');
?>