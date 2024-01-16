<?php
    session_start();
    $korisnik=$_SESSION["korisnik"];

    if(!isset($korisnik)){
        header('Location:/Seca-Suma/index.php');
    }

    $StariDoprinosID=$_POST['StariDoprinosID'];
    $DoprinosID=$_POST['DoprinosID'];

    $VrstaDrveta=$_POST['VrstaDrveta'];
    $PovrsinaSume=$_POST['PovrsinaSume'];
    $Datum=$_POST['Datum'];
    $Neto=$_POST['Neto'];
    $Mesto=$_POST['Mesto'];

    if(isset($_POST['Trosak'])){
        $Trosak = $_POST['Trosak'];
    }else{
        $StariTrosak=$_POST['Trosak'];
        $UkupanTrosak = $StariTrosak;
    }

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

    // ostvaruje se konekcija 
   $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml");
   $KonekcijaObject->connect();

   if($KonekcijaObject->konekcijaDB){
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSece.php";
    $ZakazaneSeceObject = new DBZakazaneSece($KonekcijaObject, 'zakazanaseca');
    $greska = $ZakazaneSeceObject->IzmeniZakazanuSecu($StariDoprinosID, $DoprinosID, $VrstaDrveta, $PovrsinaSume, $Datum, $Neto, $Mesto, $Trosak);
   }else{
    echo "Nije uspostavljena konekcija sa bazom podataka!";
   }

   $KonekcijaObject->disconnect();
   header('Location:/Seca-Suma/FrontEnd/src/Stranice/ZakazaneSece/zakazaneSeceAdmin.php');

?>