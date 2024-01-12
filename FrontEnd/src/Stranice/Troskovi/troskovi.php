<?php
    session_start();
    session_unset();
    session_destroy();

    require "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php"
    $KonekcijaObject = new Konekcija('/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    // ako je uspesno ostvarena konekcija na DB uradi sledece
    if($KonekcijaObject->konekcijaDB){
        require "/SECA-SUMA/BackEnd/Klase/DBZakazaneSeceV.php";
        $TroskoviViewObject = new DBZakazaneSece($KonekcijaObject,"Troskovi")
        if(isset($_GET['filtriraj'])){
            $filter=$_GET['filter'];
            $TroskoviViewObject->DajSvePodatkeOPredhodnimSecama($filter);
        }else{
            $filter=null;
            $TroskoviViewObject->DajSvePodatkeOPredhodnimSecama($filter);
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
    <link href="/SECA-SUMA/FrontEnd/src/Delovi/Troskovi/troskovi.css" type="text/css" rel="stylesheet">
    <title>Potrošnja</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/header.php"?>
    <section class="troskovi">
    <div class="troskovi__h1Wrap">
        <h1 class="troskovi__h1">Troškovi</h1>
    </div>
    <?php
            if ($TroskoviViewObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo "UKUPAN BROJ ZAPISA:".$TroskoviViewObject->BrojZapisa;
               echo' <table class="table troskovi__table">';
               echo' <thead class="troskovi__thead">';
               echo'     <tr class="troskovi__headTr">';
               echo'         <th>R.Broj</th>';
               echo'         <th>UkupanTrosak</th>';
               echo'        <th>NazivDrveta</th>';
               echo'     </tr>';
               echo' </thead>';

               for($RBZapisa = 0;$RBZapisa < $TroskoviViewObject->BrojZapisa;$RBZapisa++){
                $UkupanTrosak=$TroskoviViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($TroskoviViewObject->Kolekcija, $RBZapisa,1);
                $NazivDrveta=$TroskoviViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($TroskoviViewObject->Kolekcija, $RBZapisa,2);

                echo'<tr>';
                echo'<td>'$UkupanTrosak'</td>';
                echo'<td>'$NazivDrveta'</td>';
                echo'</tr>';
                echo' <tbody class="troskovi__tableBody">';
                echo' </tbody>';
                echo'</table>';
               }
            }
            $KonekcijaObject->disconnect();
        ?>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
</html>