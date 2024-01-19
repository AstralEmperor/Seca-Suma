<?php
    session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
	   // proverava informacije u sesiji za korisnika
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako korisnik nije prijavljen, vraca ga na pocetnu stranicu
				if (!isset($korisnik)){
					header ('Location:/Seca-Suma/index.php');
				}	

// konektovanje na bazu
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    
    // ako je uspesno ostvarena konekcija na DB, pozovi pogled i funkciju koja vraca podatke
    if($KonekcijaObject->konekcijaDB){
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSeceV.php";
        $ZakazaneSeceViewObject = new DBZakazaneSece($KonekcijaObject,"zakazanaseca");
        if(isset($_POST['filtriraj'])){
            $filter=$_POST['filter'];
            $ZakazaneSeceViewObject->DajSvePodatkeOZakazanimSecamaPlacenimUnapred($filter);;
        }else{
            $filter=null;
            $ZakazaneSeceViewObject->DajSvePodatkeOZakazanimSecamaPlacenimUnapred($filter);;
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
        <h1>Seča šuma sa plaćanjem u napred</h1>
    </div>
    <div class="stampa__p">
        <p>Seče sa plaćanjem unapred:</p>
    </div>
        <?php
            if ($ZakazaneSeceViewObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               $BrojObjekata = 0;
               echo' <table>';
               echo' <thead>';
               echo'     <tr>';
               echo'         <th>R.Broj</th>';
               echo'         <th>VrstaDrveta</th>';
               echo'         <th>PovrsinaSume</th>';
               echo'         <th>Datum</th>';
               echo'         <th>Neto</th>';
               echo'         <th>Trosak</th>';
               echo'         <th>Mesto</th>';
               echo'         <th>Placeno Unapred</th>';
               echo'     </tr>';
               echo' </thead>';
               echo'<tbody>';

               for($RBZapisa = 0; $RBZapisa < $ZakazaneSeceViewObject->BrojZapisa; $RBZapisa++){
                $DoprinosID=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,0);
                $VrstaDrveta=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,1);
                $PovrsinaSume=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,2);
                $Datum=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,3);
                $Neto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,4);
                $Mesto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,5);
                $Trosak=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,6);
                $PlacenoUnapred=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,7);

                if($PlacenoUnapred > 0){
                    $BrojObjekata++;
                    echo'<tr>';
                    echo'<td>' .$BrojObjekata.'</td>';
                    echo'<td>' .$VrstaDrveta. '</td>';
                    echo'<td>' .$PovrsinaSume. ' m<sup>3</sup></td>';
                    echo'<td>' .$Datum. '</td>';
                    echo'<td>' .$Neto. ' $</td>';
                    echo'<td>' .$Mesto. '</td>';
                    echo'<td>' .$Trosak. ' $</td>';
                    echo'<td>' .$PlacenoUnapred. ' $</td>';
                    echo'</tr>';
                }
                
               }
               echo'</tbody>';
               echo'</table>';
               echo'<br>';
               echo'<br>';
               echo'Ukupan broj Zapisa:'.$BrojObjekata;
            }
            $KonekcijaObject->disconnect();
        ?>
        <input class="button" type="submit" name="stampaj" value="STAMPAJ">
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
</html>