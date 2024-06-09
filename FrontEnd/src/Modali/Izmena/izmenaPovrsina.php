<?php
    session_start();
    $korisnik=$_SESSION["korisnik"];

    if(!isset($korisnik)){
        header('Location:/Seca-Suma/index.php');
    }

    $StaraPovrsinaID=$_POST['staraPovrsinaID'];
    $povrsinaID=$_POST['povrsinaID'];

    $PovrsinaZaSecu=$_POST['povrsinaZaSecu'];
    $UkupnaPovrsina=$_POST['ukupnaPovrsina'];
    $Mladice=$_POST['mladice'];
    $Praznina=$_POST['praznina'];


    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

    // ostvaruje se konekcija 
   $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml");
   $KonekcijaObject->connect();

   if($KonekcijaObject->konekcijaDB){
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBPovrsina.php";
    $PovrsinaObject = new DBPovrsina($KonekcijaObject, 'povrsina');
    $greska = $PovrsinaObject->IzmeniPovrsinu($StaraPovrsinaID, $povrsinaID, $PovrsinaZaSecu, $UkupnaPovrsina, $Mladice, $Praznina);
   }else{
    echo "Nije uspostavljena konekcija sa bazom podataka!";
   }

   $KonekcijaObject->disconnect();
   header('Location:/Seca-Suma/FrontEnd/src/Stranice/Povrsina/povrsinaAdmin.php');

?>