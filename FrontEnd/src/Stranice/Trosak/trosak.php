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
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBTrosak.php";
        $TroskoviObject = new DBTrosak($KonekcijaObject,"TROSAK");
        if(isset($_GET['filtriraj'])){
            $filter=$_GET['filter'];
            $TroskoviObject->DajSvePodatkeOTroskovima($filter);
        }else{
            $filter=null;
            $TroskoviObject->DajSvePodatkeOTroskovima($filter);
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
    <link href="trosak.css" type="text/css" rel="stylesheet">
    <title>Troškovi</title>
</head>
<body class="glavniKontejner body">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/header.php"?>
<section class="seca">
    <div class="seca__h1Wrap">
        <h1 class="seca__h1">Evidencija Troškova</h1>
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
            if ($TroskoviObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo' <table class="table seca__table">';
               echo' <thead class="seca__thead">';
               echo'     <tr class="seca__headTr">';
               echo'         <th>R.Broj</th>';
               echo'         <th>Plate</th>';
               echo'         <th>PrevozniTrošak</th>';
               echo'         <th>MašineTrošak</th>';
               echo'     </tr>';
               echo' </thead>';
               echo'<tbody class="seca__tableBody">';

               for($RBZapisa = 0; $RBZapisa < $TroskoviObject->BrojZapisa; $RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $Plate=$TroskoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($TroskoviObject->Kolekcija, $RBZapisa,1);
                $PrevozniTrosak=$TroskoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($TroskoviObject->Kolekcija, $RBZapisa,2);
                $MasineTrosak=$TroskoviObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($TroskoviObject->Kolekcija, $RBZapisa,3);

                echo'<tr>';
                echo'<td>' .$Rbroj.'</td>';
                echo'<td>' .$Plate. '</td>';
                echo'<td>' .$PrevozniTrosak. '</td>';
                echo'<td>' .$MasineTrosak. '</td>';
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