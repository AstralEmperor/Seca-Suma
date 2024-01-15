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
        if(isset($_GET['filtriraj'])){
            $filter=$_GET['filter'];
            $ZakazaneSeceViewObject->DajSvePodatkeOZakazanimSecema($filter);
        }else{
            $filter=null;
            $ZakazaneSeceViewObject->DajSvePodatkeOZakazanimSecema($filter);
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
    <title>Zakazane Sece</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/headerAdmin.php"?>
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
        <?php
            if ($ZakazaneSeceViewObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo' <table class="table zarada__table">';
               echo' <thead class="zarada__thead">';
               echo'     <tr class="zarada__headTr">';
               echo'         <th>R.Broj</th>';
               echo'         <th>VrstaDrveta</th>';
               echo'         <th>PovrsinaSume(m3)</th>';
               echo'         <th>Datum</th>';
               echo'         <th>Neto($)</th>';
               echo'         <th>Mesto</th>';
               echo'         <th>Trosak($)</th>';
               echo'         <th>Edituj</th>';
               echo'         <th>Obrisi</th>';
               echo'     </tr>';
               echo' </thead>';
               echo'<tbody class="troskovi__tableBody">';

               for($RBZapisa = 0; $RBZapisa < $ZakazaneSeceViewObject->BrojZapisa; $RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $DoprinosID=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,0);
                $VrstaDrveta=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,0);
                $PovrsinaSume=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,1);
                $Datum=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,2);
                $Neto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,3);
                $Trosak=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,4);
                $Mesto=$ZakazaneSeceViewObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceViewObject->Kolekcija, $RBZapisa,5);

                echo'<tr>';
                echo'<td>' .$Rbroj.'</td>';
                echo'<td>' .$VrstaDrveta. '</td>';
                echo'<td>' .$PovrsinaSume. '</td>';
                echo'<td>' .$Datum. '</td>';
                echo'<td>' .$Neto. '</td>';
                echo'<td>' .$Mesto. '</td>';
                echo'<td>' .$Trosak. '</td>';
                echo'<td><form action="" method="POST"><img src="/SECA-SUMA/FrontEnd/Assets/edit-text.png" alt="edit.png"></form></td>';
                echo'<td><form action="/SECA-SUMA/FrontEnd/src/Modali/Brisanje/ZakazaneSeceobrisi.php" method="POST"><input type="submit" name="Obrisi" value="Obrisi"></form></td>';
                echo'</tr>';
               }
            }
            $KonekcijaObject->disconnect();
        ?>
        </tbody>
    </table>
    <aside class="leviMeni">
                <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/LeviMeni/leviMeni.php"?>
            </aside>
    <div class="zarada__formShow"><?php include $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Modali/ZakazaneSece_noveSece/zakazaneSece_dodajNovo.php"?></div>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
<script src="zakazaneSece.js"></script>
</html>