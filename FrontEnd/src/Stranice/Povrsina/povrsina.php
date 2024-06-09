<?php
    session_start();
    session_unset();
    session_destroy();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    // ako je uspesno ostvarena konekcija na DB uradi sledece
    if($KonekcijaObject->konekcijaDB){
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBPovrsina.php";
        $PovrsinaObject = new DBPovrsina($KonekcijaObject,"POVRSINA");
        if(isset($_GET['filtriraj'])){
            $filter=$_GET['filter'];
            $PovrsinaObject->DajSvePodatkeOPovrsiniZaSecu($filter);
        }else{
            $filter=null;
            $PovrsinaObject->DajSvePodatkeOPovrsiniZaSecu($filter);
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
    <link href="povrsina.css" type="text/css" rel="stylesheet">
    <title>Sve Površine</title>
</head>
<body class="glavniKontejner body">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/header.php"?>
<section class="seca">
    <div class="seca__h1Wrap">
        <h1 class="seca__h1">Evidencija Površina Šuma</h1>
    </div>
        <div class="seca__optionsWrap">
        <label for="pretraga" class="seca__pretragaLabel">Pretraga</label>
            <form name="pretraga" class="seca__pretragaForm">
               <div class="seca__pretragaBar">
                    <input name="filter" id="filter" class="seca__Filter input" placeholder="Unesi vrednost">
                    <button class="seca__filterBtn button" type="submit" name="filtriraj"><img src="/SECA-SUMA/FrontEnd/Assets/Search_icon.png" alt="search.png"></button>
               </div>
               <div class="seca__pretragaBar">
                 <button type="submit" name="svi" id="svi" class="seca__sviPodatci button">PRIKAŽI SVE
               </div>
            </form>
        </div>
        <?php
            if ($PovrsinaObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo' <table class="table seca__table">';
               echo' <thead class="seca__thead">';
               echo'     <tr class="seca__headTr">';
               echo'         <th>R.Broj</th>';
               echo'         <th>UkupnaPovrsina(km²)</th>';
               echo'         <th>Mladice(km²)</th>';
               echo'         <th>Praznina(km²)</th>';
               echo'     </tr>';
               echo' </thead>';
               echo'<tbody class="seca__tableBody">';

               for($RBZapisa = 0; $RBZapisa < $PovrsinaObject->BrojZapisa; $RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $UkupnaPovrsina=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($PovrsinaObject->Kolekcija, $RBZapisa,1);
                $Mladice=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($PovrsinaObject->Kolekcija, $RBZapisa,2);
                $Praznina=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($PovrsinaObject->Kolekcija, $RBZapisa,3);

                echo'<tr>';
                echo'<td>' .$Rbroj.'</td>';
                echo'<td>' .$UkupnaPovrsina. '</td>';
                echo'<td>' .$Mladice. '</td>';
                echo'<td>' .$Praznina. '</td>';
                echo'</tr>';
               }
            }
            $KonekcijaObject->disconnect();
        ?>
        </tbody>
    </table>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php" ?></footer>
</body>
</html>