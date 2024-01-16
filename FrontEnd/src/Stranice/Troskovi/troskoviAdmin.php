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
    $KonekcijaObject = new Konekcija( $_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    // ako je uspesno ostvarena konekcija na DB uradi sledece
    if($KonekcijaObject->konekcijaDB){
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBTroskovi.php";
        $MestaObject = new DBTroskovi($KonekcijaObject,"Troskovi");
        $KolekcijaZapisa = $MestaObject ->UcitajKolekcijuSvihMesta();
        $UkupanBrojZapisa = $MestaObject->DajUkupanBrojSvihMesta($KolekcijaZapisa);
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
    <link href="/SECA-SUMA/FrontEnd/src/Stranice/Troskovi/troskovi.css" type="text/css" rel="stylesheet">
    <title>Potrošnja</title>
</head>
<body class="glavniKontejner mesta">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/headerAdmin.php"?>
  <section class="index">
    <div class="sadrzajAside">
            <aside class="leviMeni">
                <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/LeviMeni/leviMeni.php"?>
            </aside>
    </div>
<div class="mesta__sadrzaj mesta">
    <div class="mesta__h1Wrap">
        <h1 class="mesta__h1">Seče po mestima</h1>
    </div>
    <?php
            if ($MestaObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo' <table class="table mesta__table">';
               echo' <thead class="mesta__thead">';
               echo'     <tr class="mesta__headTr">';
               echo'         <th>R.Broj</th>';
               echo'         <th>Mesto</th>';
               echo'         <th>UkupanBrojSeca</th>';
               echo'     </tr>';
               echo' </thead>';
               echo' <tbody class="mesta__tableBody">';

            for($RBZapisa = 0;$RBZapisa < $MestaObject->BrojZapisa;$RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $Mesto=$MestaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($MestaObject->Kolekcija, $RBZapisa,0);
                $UkupanBrojSeca=$MestaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($MestaObject->Kolekcija, $RBZapisa,1);

                echo'<tr>';
                echo'<td>'.$Rbroj.'</td>';
                echo'<td>'.$Mesto.'</td>';
                echo'<td>'.$UkupanBrojSeca.'</td>';
                echo'</tr>';
               }
            }
            $KonekcijaObject->disconnect();
        ?>
        </tbody>
    </table>
</div>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
</html>