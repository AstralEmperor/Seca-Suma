<?php
    session_start();
    $korisnik=$_SESSION["korisnik"];

    if(!isset($korisnik)){
        header('Location:/Seca-Suma/index.php');
    }

    $StariTrosakID=$_POST['trosakID'];
    $trosakID=$_POST['trosakID'];

    $ukupanTrosak=$_POST['ukupanTrosak'];
    $plate=$_POST['plate'];
    $prevozniTrosak=$_POST['prevozniTrosak'];
    $masineTrosak=$_POST['masineTrosak'];

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

    // ostvaruje se konekcija 
   $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml");
   $KonekcijaObject->connect();

   if($KonekcijaObject->konekcijaDB){
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBTrosak.php";
    $TrosakObject = new DBTrosak($KonekcijaObject, 'trosak');
    $greska = $TrosakObject->IzmeniTrosak($StariTrosakID, $trosakID, $ukupanTrosak, $plate, $prevozniTrosak, $masineTrosak);
   }else{
    echo "Nije uspostavljena konekcija sa bazom podataka!";
   }

   $KonekcijaObject->disconnect();
   header('Location:/Seca-Suma/FrontEnd/src/Stranice/Trosak/trosakAdmin.php');

?>