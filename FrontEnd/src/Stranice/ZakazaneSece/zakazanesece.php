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
        require "/SECA-SUMA/BackEnd/Klase/DBZakazaneSece.php";
        $ZakazaneSeceViewObject = new DBZakazaneSece($KonekcijaObject,"zakazanaseca")
        if(isset($_GET['filtriraj'])){
            $filter=$_GET['filter'];
            $ZakazaneSeceViewObject->DajSvePodatkeOPredhodnimSecama($filter);
        }else{
            $filter=null;
            $ZakazaneSeceViewObject->DajSvePodatkeOPredhodnimSecama($filter);
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
    <link href="zakazaneSece.css" type="text/css" rel="stylesheet">
    <title>Zarada</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/header.php"?>
<section class="zarada">
    <div class="zarada__h1Wrap">
        <h1 class="zarada__h1">Evidencija Seča Šuma</h1>
    </div>
        <div class="zarada__optionsWrap">
        <div class="zarada__addBtnWrap">
                <button class="zarada__addNew button">DODAJ ZAKAZANU SEČU</button>
            </div>
            <div class="zarada__pretraga">
               <label for="filterSece">Pretraga</label>
               <div class="zarada__pretragaBar">
                    <Input name="filterSece" id="filterSece" class="zarada__Filter input" placeholder="Unesi vrednost">
                    <button class="zarada__filterBtn button"><img src="/SECA-SUMA/FrontEnd/Assets/Search_icon.png" alt="search.png"></button>
               </div>
            </div>
        </div>
    <table class="table zarada__table">
        <thead class="zarada__thead">
            <tr class="zarada__headTr">
                <th>R.broj</th>
                <th>Vrsta Drveta</th>
                <th>Površina Šume(m3)</th>
                <th>Datum</th>
                <th>Neto($)</th>
                <th>Mesto</th>
                <th>Trošak($)</th>
                <th>Edituj</th>
                <th>Obriši</th>
            </tr>
        </thead>
        <tbody class="zarada__tableBody">
        <?php
            if ($ZakazaneSeceViewObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo "UKUPAN BROJ ZAPISA:".$ZakazaneSeceViewObject->BrojZapisa;
               echo' <table class="table zarada__table">';
               echo' <thead class="zarada__thead">';
               echo'     <tr class="zarada__headTr">';
               echo'         <th>VrstaDrveta</th>';
               echo'         <th>PovrsinaSume</th>';
               echo'         <th>Datum</th>';
               echo'         <th>Neto</th>';
               echo'         <th>Mesto</th>';
               echo'         <th>Trosak</th>';
               echo'     </tr>';
               echo' </thead>';

               for($RBZapisa = 0;$RBZapisa < $ZakazaneSeceViewObject->BrojZapisa;$RBZapisa++){
                $DoprinosID=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,0);
                $VrstaDrveta=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,1);
                $PovrsinaSume=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,2);
                $Datum=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,3);
                $Neto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,4);
                $Mesto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,5);
                $Trosak=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,5);

                echo'<tr>';
                echo'<td>'$VrstaDrveta'</td>';
                echo'<td>'$PovrsinaSume'</td>';
                echo'<td>'$Datum'</td>';
                echo'<td>'$Neto'</td>';
                echo'<td>'$Mesto'</td>';
                echo'<td>'$Trosak'</td>';
                echo'</tr>';
                echo' <tbody class="troskovi__tableBody">';
                echo' </tbody>';
                echo'</table>';
               }
            }
            $KonekcijaObject->disconnect();
        ?>
        </tbody>
    </table>
    <div class="zarada__formShow"><?php include $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Modali/ZakazaneSece_noveSece/zakazaneSece_dodajNovo.php"?></div>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
<script src="zakazaneSece.js"></script>
</html>