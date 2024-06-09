<?php
    session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
	   // proverava informacije u sesiji za korisnika
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako korisnik nije prijavljen, vraca ga na pocetnu stranicu
				if (!isset($korisnik)){
					header ('Location:/Seca-Suma/index.php');
				}	


    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    
    // ako je uspesno ostvarena konekcija na DB uradi sledece
    if($KonekcijaObject->konekcijaDB){
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSece.php";
        $ZakazaneSeceObject = new DBZakazaneSece($KonekcijaObject,"zakazanaseca");
        if(isset($_POST['filtriraj'])){
            $filter=$_POST['filter'];
            $ZakazaneSeceObject->DajSvePodatkeOZakazanimSecama($filter);
        }else{
            $filter=null;
            $ZakazaneSeceObject->DajSvePodatkeOZakazanimSecama($filter);
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
<?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/headerAdmin.php"?>
  <section class="index">
    <div class="stampa__h1">
        <h1>SPISAK ZAKAZANIH SEČA</h1>
    </div>
    <div class="stampa__p">
        <p>Predstojeće seče:</p>
    </div>
        <?php
            if ($ZakazaneSeceObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo' <table>';
               echo' <thead>';
               echo'     <tr>';
               echo'         <th>R.Broj</th>';
               echo'         <th>VrstaDrveta</th>';
               echo'         <th>PovrsinaSumeID</th>';
               echo'         <th>Datum</th>';
               echo'         <th>Neto</th>';
               echo'         <th>Mesto</th>';
               echo'         <th>TrosakID</th>';
               echo'         <th>Plaćeno unapred</th>';
               echo'     </tr>';
               echo' </thead>';
               echo'<tbody>';

               for($RBZapisa = 0; $RBZapisa < $ZakazaneSeceObject->BrojZapisa; $RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $DoprinosID=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,0);
                $VrstaDrveta=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,1);
                $PovrsinaSume=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,2);
                $Datum=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,3);
                $Neto=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,4);
                $Trosak=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,6);
                $Mesto=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,5);
                $PlacenoUnapred=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,7);

                    echo'<tr>';
                    echo'<td>' .$Rbroj.'</td>';
                    echo'<td>' .$VrstaDrveta. '</td>';
                    echo'<td>' .$PovrsinaSume. '</td>';
                    echo'<td>' .$Datum. '</td>';
                    echo'<td>' .$Neto. ' $</td>';
                    echo'<td>' .$Mesto. '</td>';
                    echo'<td>' .$Trosak. '</td>';
                    echo'<td>' .$PlacenoUnapred. '</td>';
                    echo'</tr>';
                
               }
               echo'</tbody>';
               echo'</table>';
               echo'<br>';
               echo'<br>';
               echo'Ukupan broj Zapisa:'.$ZakazaneSeceObject->BrojZapisa;
            }
            $KonekcijaObject->disconnect();
        ?>
        <input class="button stampaj" type="submit" name="stampaj" value="STAMPAJ">
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
</html>