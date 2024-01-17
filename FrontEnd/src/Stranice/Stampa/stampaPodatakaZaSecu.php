<?php
 session_start();

 require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
 // proverava informacije u sesiji za korisnika
 $korisnik=$_SESSION["korisnik"];

 	  // ako korisnik nije prijavljen, vraca ga na pocetnu stranicu
       if (!isset($korisnik)){
        header ('Location:/Seca-Suma/index.php');
    }	
// ako je uspesno ostvarena konekcija na DB, pozovi pogled i funkciju koja vraca podatke
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    // ako je uspesno ostvarena konekcija na DB uradi sledece
    if($KonekcijaObject->konekcijaDB){
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSeceV.php";
        $ZakazaneSeceViewObject = new DBZakazaneSece($KonekcijaObject,"zakazanaseca");
        if(isset($_GET['filtriraj'])){
            $filter=$_GET['filter'];
            $ZakazaneSeceViewObject->DajSvePodatkeOZakazanimSecamaPlacenimUnapred($filter);
        }
    }else{
        echo"Neuspesna konekcija";
    }
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
    <link href="stampa.css" type="text/css" rel="stylesheet">
    <title>Štampa</title>
</head>
<body class="body-stampa">
<section>
                <div class="stampa__h1">
                    <h1>Štampa Seča po Vrsti Drveta</h1>
                 </div>
            <form name="pretraga" class="stampa__pretragaForm">
               <div class="seca__pretragaBar">
               <label for="filter" class="label">Vrsta Drveta</label>
               <input type="combobox" name="filter" id="filter" class="input" list="vrstaLista" placeholder="--Vrsta Drveta--">
                    <datalist id="vrstaLista">
                    <?php
                        if ($ZakazaneSeceViewObject->BrojZapisa==0)
                        {
                            echo '<option value="Nema Zapisa">';
                        }else{
                            for($RBZapisa = 0; $RBZapisa < $ZakazaneSeceViewObject->BrojZapisa; $RBZapisa++){
                                $ID=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,0);
                                $Vrsta=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,1);
                                echo'<option value="'.$Vrsta.'">';
                            }
                        }
                    ?>
                    </datalist>
                    <button class="stampa__filterBtn button" type="submit" name="filtriraj"><img src="/SECA-SUMA/FrontEnd/Assets/Search_icon.png" alt="search.png"></button>
               </div>
            </form>
            <?php
            if ($ZakazaneSeceViewObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               for($RBZapisa = 0; $RBZapisa < $ZakazaneSeceViewObject->BrojZapisa; $RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $VrstaDrveta=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,1);
                $PovrsinaSume=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,2);
                $Datum=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,3);
                $Neto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,4);
                $Trosak=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,5);
                $Mesto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,6);
                $PlacenoUnapred=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,7);

                echo'<div class="stampa__izabranaSeca">';
                echo'<div><p>Vrsta Drveta: </p><p>' .$VrstaDrveta. '</p></div>';
                echo'<div><p>Povrsina Šume: </p><p>' .$PovrsinaSume. ' m<sup>3</sup></p></div>';
                echo'<div><p>Datum: </p><p>' .$Datum. '</p></div>';
                echo'<div><p>Neto: </p><p>'  .$Neto. ' $</p></div>';
                echo'<div><p>Trosak: </p><p>' .$Trosak. ' $</p></div>';
                echo'<div><p>Mesto: </p><p>' .$Mesto. '</p></div>';
                echo'<div><p>PlacenoUnapred: </p><p>' .$PlacenoUnapred. ' $</p></div>';
                echo'</div>';
               }
            }
            $KonekcijaObject->disconnect();
        ?>
        <input class="button" type="submit" name="stampaj" value="STAMPAJ">
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
</html>