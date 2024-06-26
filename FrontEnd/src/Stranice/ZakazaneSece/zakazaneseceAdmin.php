<?php
    session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
	   // proverava informacije u sesiji za korisnika
	   $korisnik=$_SESSION["korisnik"];
       $ovlascenje=$_SESSION["ovlascenje"];
      
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
        if(isset($_GET['filtriraj'])){
            $filter=$_GET['filter'];
            $ZakazaneSeceObject->DajSvePodatkeOZakazanimSecama($filter);
        }else{
            $filter=null;
            $ZakazaneSeceObject->DajSvePodatkeOZakazanimSecama($filter);
        }
    }else{
        echo"Neuspesna konekcija";
    }
    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBMesta.php";
    $MestoObject = new DBMesto($KonekcijaObject, "mesto");
    $MestoObject->UcitajKolekcijuSvihMesta();
    $KolekcijaZapisaMesta = $MestoObject->Kolekcija;
    $UkupanBrojZapisaMesta = $MestoObject->BrojZapisa;

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBTrosak.php";
    $TrosakObject = new DBTrosak($KonekcijaObject, "trosak");
    $TrosakObject->UcitajKolekcijuSvihTroskova();
    $KolekcijaZapisaTroskova = $TrosakObject->Kolekcija;
    $UkupanBrojZapisaTroskova = $TrosakObject->BrojZapisa;

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBPovrsina.php";
    $PovrsinaObject = new DBPovrsina($KonekcijaObject, "povrsina");
    $PovrsinaObject->UcitajKolekcijuSvihPovrsina();
    $KolekcijaZapisaPovrsina = $PovrsinaObject->Kolekcija;
    $UkupanBrojZapisaPovrsina = $PovrsinaObject->BrojZapisa;
?>
<!DOCTYPE html>
<html lang="sr" class="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
    <link href="zakazaneSece.css" type="text/css" rel="stylesheet">
    <title>Zakazane Sece</title>
</head>
<body class="glavniKontejner seca body">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/headerAdmin.php"?>
  <section class="index">
  <div class="sadrzajAside">
            <aside class="leviMeni">
                <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/LeviMeni/leviMeni.php"?>
            </aside>
</div>
<div class="seca__sadrzaj seca">
    <div class="seca__h1Wrap">
        <h1 class="seca__h1">Evidencija Seča Šuma</h1>
    </div>
        <div class="seca__optionsWrap">
            <?php 
            if($ovlascenje === "admin"){
                echo'<div class="seca__addBtnWrap">';
                echo' <button class="seca__dodajNovu button">ZAKAŽI SEČU</button>';
                echo'</div>';
                }
                else{
                echo '';
              }
            ?>
            <form name="pretraga" class="seca__pretragaForm">
               <div class="seca__pretragaBar">
                    <input name="filter" id="filter" class="seca__Filter input" placeholder="Unesi vrednost" pattern="[A-Za-z]{1,12}" oninvalid="this.setCustomValidity('Molimo vas unesite 3 do 15 slova(A-z)')" oninput="setCustomValidity('')">
                    <button class="seca__filterBtn button" type="submit" name="filtriraj"><img src="/SECA-SUMA/FrontEnd/Assets/Search_icon.png" alt="search.png"></button>
               </div>
               <div class="seca__pretragaBar">
                 <button type="submit" name="svi" id="svi" class="seca__sviPodatci button">PRIKAŽI SVE
               </div>
            </form>
        </div>
        <?php
            if ($ZakazaneSeceObject->BrojZapisa==0)
            {
                echo "nema zapisa!";
            }
        else
            {
               echo' <table class="table seca__table">';
               echo' <thead class="seca__thead">';
               echo'     <tr class="seca__headTr">';
               echo'         <th>R.Broj</th>';
               echo'         <th>VrstaDrveta</th>';
               echo'         <th>PovrsinaSumeID</th>';
               echo'         <th>Datum</th>';
               echo'         <th>Neto($)</th>';
               echo'         <th>Mesto</th>';
               echo'         <th>Trosak Pri Radu ID</th>';
               if($ovlascenje === "admin"){
               echo'         <th>Edituj</th>';
               echo'         <th>Obrisi</th>';
               }
               echo'     </tr>';
               echo' </thead>';
               echo'<tbody class="seca__tableBody">';

               for($RBZapisa = 0; $RBZapisa < $ZakazaneSeceObject->BrojZapisa; $RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $SecaID=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,0);
                $VrstaDrveta=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,1);
                $PovrsinaSumeID=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,2);
                $Datum=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,3);
                $Neto=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,4);
                $TrosakPriRaduID=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,5);
                $Mesto=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($ZakazaneSeceObject->Kolekcija, $RBZapisa,6);
                
                echo'<tr>';
                echo'<td>' .$Rbroj.'</td>';
                echo'<td>' .$VrstaDrveta. '</td>';
                echo'<td>' .$PovrsinaSumeID. '</td>';
                echo'<td>' .$Datum. '</td>';
                echo'<td>' .$Neto. '</td>';
                echo'<td>' .$TrosakPriRaduID. '</td>';
                echo'<td>' .$Mesto. '</td>';
                if($ovlascenje === "admin"){
                echo'<td><form action="/SECA-SUMA/FrontEnd/src/Modali/Izmena/editovanjeSeca.php" class="otvaranjeEditFormeBtn" method="POST"><input type="hidden" name="SecaID" value='.$SecaID.'><input class="input-slika" type="image" src="/SECA-SUMA/FrontEnd/Assets/edit-text.png" name="EditujSecu"></form></td>';
                echo'<td><form action="/SECA-SUMA/FrontEnd/src/Modali/Brisanje/ZakazaneSeceobrisi.php" method="POST"><input type="hidden" name="SecaID" value='.$SecaID.'><input type="hidden" name="mesto" value='.$Mesto.'><input class="input-slika" type="image"src="/SECA-SUMA/FrontEnd/Assets/trash-can.png" name="ObrisiSecu"></form></td>';
                }
                echo'</tr>';
               }
            }
            $KonekcijaObject->disconnect();
        ?>
        </tbody>
    </table>
</div>
</section>
<div class="seca__formDodajOtvori"><?php include $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Modali/DodajNovo/zakazaneSece_dodajNovo.php"?></div>

    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
<script src="zakazaneSece.js"></script>
</html>