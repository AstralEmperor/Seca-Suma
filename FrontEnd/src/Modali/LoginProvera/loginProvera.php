<?php
session_start();
    $loginUserName=$_POST['korisnickoIme'];
    $loginPassword=$_POST['sifra'];

    require $_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BaznaTabela.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/DBKorisnik.php';

    $korisnik = 'Nepoznat korisnik';
    $objKonekcija = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $objKonekcija->connect();
    if($objKonekcija->konekcijaDB){
        $objKorisnik = new DBKorisnik($objKonekcija, 'korisnik');
        $postojiKorisnik=$objKorisnik->ProveraPostojanjaKorisnika($loginUserName,$loginPassword);
        if($postojiKorisnik=="DA"){
            $_SESSION["prez"] = $objKorisnik->PreuzmiPrezimePrijavljenogKorisnika($loginUserName,$loginPassword);
            $_SESSION["ime"] = $objKorisnik->PreuzmiImePrijavljenogKorisnika($loginUserName,$loginPassword);
            $_SESSION["idkorisnika"] = $objKorisnik->PreuzmiIdPrijavljenogKorisnika($loginUserName,$loginPassword);
            $_SESSION["korisnik"] = $objKorisnik->PreuzmiImeIPrezimePrijavljenogKorisnika($loginUserName,$loginPassword);
            $_SESSION["ovlascenje"] = $objKorisnik->PreuzmiOvlascenjeKorisnika($loginUserName,$loginPassword);

            header('Location:/SECA-SUMA/welcome.php');
        }else{
            header('Location:/SECA-SUMA/index.php');
        }
    }else{
        echo"Neuspeh konekcije na bazu podataka!!!";
    }
?>