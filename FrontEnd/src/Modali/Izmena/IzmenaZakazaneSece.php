<?php
    session_start();
    $korisnik=$_SESSION["korisnik"];

    if(!isset($korisnik)){
        header('Location:/Seca-Suma/index.php');
    }

    $StariSecaID=$_POST['StariSecaID'];
    $SecaID=$_POST['SecaID'];

    $VrstaDrveta=$_POST['VrstaDrveta'];
    $PovrsinaSumeID=$_POST['PovrsinaSumeID'];
    $Datum=$_POST['Datum'];
    $Neto=$_POST['Neto'];
    $TrosakPriRaduID=$_POST['TrosakPriRaduID'];
    $PlacenoUnapred=$_POST['PlacenoUnapred'];

    if(isset($_POST['Mesto'])){
        $Mesto = $_POST['Mesto'];
    }else{
        $StaroMesto=$_POST['Mesto'];
    }

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

    // ostvaruje se konekcija 
   $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml");
   $KonekcijaObject->connect();

   if($KonekcijaObject->konekcijaDB){
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSece.php";
    $ZakazaneSeceObject = new DBZakazaneSece($KonekcijaObject, 'zakazanaseca');
    $greska = $ZakazaneSeceObject->IzmeniZakazanuSecu($StariSecaID, $SecaID, $VrstaDrveta, $PovrsinaSumeID, $Datum, $Neto, $TrosakPriRaduID, $Mesto, $PlacenoUnapred);
   }else{
    echo "Nije uspostavljena konekcija sa bazom podataka!";
   }

   $KonekcijaObject->disconnect();
   header('Location:/Seca-Suma/FrontEnd/src/Stranice/ZakazaneSece/zakazaneSeceAdmin.php');

?>