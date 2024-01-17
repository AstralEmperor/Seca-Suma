<?php
    session_start();
    session_unset();
    session_destroy();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija( $_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    // ako je uspesno ostvarena konekcija na DB uradi sledece
    if($KonekcijaObject->konekcijaDB){
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBmesta.php";
        $MestoObject = new DBmesto($KonekcijaObject,"mesto");
        $KolekcijaZapisa = $MestoObject ->UcitajKolekcijuSvihMesta();
        $UkupanBrojZapisa = $MestoObject->DajUkupanBrojSvihMesta($KolekcijaZapisa);
    }else{
        echo"Neuspesna konekcija";
    }
?>
<!DOCTYPE html>
<html lang="sr" class="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
    <link href="/SECA-SUMA/FrontEnd/src/Stranice/Mesta/mesta.css" type="text/css" rel="stylesheet">
    <title>Potrošnja</title>
</head>
<body class="body">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/header.php"?>
    <section class="mesta">
    <div class="mesta__h1Wrap">
        <h1 class="mesta__h1">Troškovi</h1>
    </div>
    <table class="table mesta__table">
    <?php
            if ($MestoObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo' <thead class="mesta__thead">';
               echo'     <tr class="mesta__headTr">';
               echo'         <th>R.Broj</th>';
               echo'         <th>Mesto</th>';
               echo'        <th>UkupanBrojSeca</th>';
               echo'     </tr>';
               echo' </thead>';

               for($RBZapisa = 0;$RBZapisa < $MestoObject->BrojZapisa;$RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $Mesto=$MestoObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($MestoObject->Kolekcija, $RBZapisa,0);
                $UkupanBrojSeca=$MestoObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($MestoObject->Kolekcija, $RBZapisa,1);

                echo' <tbody class="mesta__tableBody">';
                echo'<tr>';
                echo'<td>'.$Rbroj.'</td>';
                echo'<td>'.$Mesto.'</td>';
                echo'<td>'.$UkupanBrojSeca.'</td>';
                echo'</tr>';
                echo' </tbody>';
               }
            }
            $KonekcijaObject->disconnect();
        ?>
    </table>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
</html>