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
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSeceV.php";
        $ZakazaneSeceViewObject = new DBZakazaneSece($KonekcijaObject,"zakazanaseca");
        if(isset($_POST['filtriraj'])){
            $filter=$_POST['filter'];
            $ZakazaneSeceViewObject->DajSvePodatkeOZakazanimSecama($filter);
        }else{
            $filter=null;
            $ZakazaneSeceViewObject->DajSvePodatkeOZakazanimSecama($filter);
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
            if ($ZakazaneSeceViewObject->BrojZapisa==0)
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
               echo'         <th>PovrsinaSume</th>';
               echo'         <th>Datum</th>';
               echo'         <th>Neto</th>';
               echo'         <th>Mesto</th>';
               echo'         <th>Trosak</th>';
               echo'     </tr>';
               echo' </thead>';
               echo'<tbody>';

               for($RBZapisa = 0; $RBZapisa < $ZakazaneSeceViewObject->BrojZapisa; $RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $DoprinosID=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,0);
                $VrstaDrveta=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,1);
                $PovrsinaSume=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,2);
                $Datum=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,3);
                $Neto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,4);
                $Trosak=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,5);
                $Mesto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,6);

                    echo'<tr>';
                    echo'<td>' .$Rbroj.'</td>';
                    echo'<td>' .$VrstaDrveta. '</td>';
                    echo'<td>' .$PovrsinaSume. ' m<sup>3</sup></td>';
                    echo'<td>' .$Datum. '</td>';
                    echo'<td>' .$Neto. ' $</td>';
                    echo'<td>' .$Mesto. '</td>';
                    echo'<td>' .$Trosak. ' $</td>';
                    echo'</tr>';
                
               }
               echo'</tbody>';
               echo'</table>';
               echo'<br>';
               echo'<br>';
               echo'Ukupan broj Zapisa:'.$ZakazaneSeceViewObject->BrojZapisa;
            }
            $KonekcijaObject->disconnect();
        ?>
        <input class="button stampaj" type="submit" name="stampaj" value="STAMPAJ">
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
</html>