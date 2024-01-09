<?php
session_start();
    $loginUserName=$_POST['korisnickoIme'];
    $loginPassword=$_POST['sifra'];

    require '/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php';
    require '/SECA-SUMA/BackEnd/Klase/BaznaTabela.php';
    require '/SECA-SUMA/BackEnd/Klase/DBKorisnik.php';

    $korisnik = 'Nepoznat korisnik';
    $objKonekcija = new Konekcija('/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $objKonekcija->connect();
    if($objKonekcija->konekcijaDB){
        $objKorisnik = new DBKorisnik($objKonekcija, 'korisnik');
        $postojiKorisnik=$objKorisnik->ProveraPostojanjaKorisnika($loginUserName,$loginPassword);
        if($postojiKorisnik=="DA"){
            $_SESSION["prez"] = $objKorisnik->PreuzmiPrezimePrijavljenogKorisnika($loginUserName,$loginPassword);
            $_SESSION["ime"] = $objKorisnik->PreuzmiImePrijavljenogKorisnika($loginUserName,$loginPassword);
            $_SESSION["idkorisnika"] = $objKorisnik->PreuzmiIdPrijavljenogKorisnika($loginUserName,$loginPassword);
            $_SESSION["korisnik"] = $objKorisnik->PreuzmiImeIPrezimePrijavljenogKorisnika($loginUserName,$loginPassword);

            header('Location:Welcome.php');
        }else{
            header('Location:index.php');
        }
    }else{
        echo"Neuspeh konekcije na bazu podataka!!!"
    }
?>