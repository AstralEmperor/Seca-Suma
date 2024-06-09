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
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBMesta.php";
        $MestoObject = new DBMesto($KonekcijaObject,"Mesto");
        if(isset($_GET['filtriraj'])){
            $filter=$_GET['filter'];
            $MestoObject->DajSvaMestaFiltrirano($filter);
        }else{
            $filter=null;
            $MestoObject->DajSvaMestaFiltrirano($filter);
        }
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
    <link href="mesto.css" type="text/css" rel="stylesheet">
    <title>Mesta</title>
</head>
<body class="glavniKontejner mesta body">
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
    <div class="mesta__optionsWrap">
    <form name="pretraga" class="mesta__pretragaForm">
               <div class="mesta__pretragaBar">
                    <input name="filter" id="filter" class="mesta__Filter input" placeholder="Ukupan Trošak" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1-9 brojeva')" oninput="setCustomValidity('')">
                    <button class="mesta__filterBtn button" type="submit" name="filtriraj"><img src="/SECA-SUMA/FrontEnd/Assets/Search_icon.png" alt="search.png"></button>
               </div>
               <div class="mesta__pretragaBar">
                 <button type="submit" name="svi" id="svi" class="mesta__sviPodatci button">PRIKAŽI SVE
               </div>
        </form>
</div>
    <?php
            if ($MestoObject->BrojZapisa==0)
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

            for($RBZapisa = 0;$RBZapisa < $MestoObject->BrojZapisa;$RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $Mesto=$MestoObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($MestoObject->Kolekcija, $RBZapisa,0);
                $UkupanBrojSeca=$MestoObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($MestoObject->Kolekcija, $RBZapisa,1);

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