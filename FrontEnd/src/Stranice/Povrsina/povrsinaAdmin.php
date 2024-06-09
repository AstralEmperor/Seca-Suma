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
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBPovrsina.php";
        $PovrsinaObject = new DBPovrsina($KonekcijaObject,"Povrsina");
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
        <h1 class="seca__h1">Evidencija Površina</h1>
    </div>
        <div class="seca__optionsWrap">
            <?php 
            if($ovlascenje === "admin"){
                echo'<div class="seca__addBtnWrap">';
                echo' <button class="seca__dodajNovu button">DODAJ POVRŠINU</button>';
                echo'</div>';
                }
                else{
                echo '';
              }
            ?>
            <form name="pretraga" class="seca__pretragaForm">
               <div class="seca__pretragaBar">
                    <input name="filter" id="filter" class="seca__Filter input" placeholder="Površina za seču" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')">
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
               echo'         <th>Površina Za Seču</th>';
               echo'         <th>Ukupna Površina</th>';
               echo'         <th>Mladice</th>';
               echo'         <th>Praznina</th>';
               if($ovlascenje === "admin"){
               echo'         <th>Edituj</th>';
               echo'         <th>Obriši</th>';
               }
               echo'     </tr>';
               echo' </thead>';
               echo'<tbody class="seca__tableBody">';

               for($RBZapisa = 0; $RBZapisa < $PovrsinaObject->BrojZapisa; $RBZapisa++){
                $Rbroj = $RBZapisa + 1;
                $povrsinaID=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($PovrsinaObject->Kolekcija, $RBZapisa,0);
                $povrsinaZaSecu=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($PovrsinaObject->Kolekcija, $RBZapisa,1);
                $ukupnaPovrsina=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($PovrsinaObject->Kolekcija, $RBZapisa,2);
                $mladice=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($PovrsinaObject->Kolekcija, $RBZapisa,3);
                $praznina=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($PovrsinaObject->Kolekcija, $RBZapisa,4);
                
                echo'<tr>';
                echo'<td>' .$Rbroj.'</td>';
                echo'<td>' .$povrsinaZaSecu. '</td>';
                echo'<td>' .$ukupnaPovrsina. '</td>';
                echo'<td>' .$praznina. '</td>';
                echo'<td>' .$mladice. '</td>';
                if($ovlascenje === "admin"){
                echo'<td><form action="/SECA-SUMA/FrontEnd/src/Modali/Izmena/editovanjePovrsina.php" class="otvaranjeEditFormeBtn" method="POST"><input type="hidden" name="povrsinaID" value='.$povrsinaID.'><input class="input-slika" type="image" src="/SECA-SUMA/FrontEnd/Assets/edit-text.png" name="EditujSecu"></form></td>';
                echo'<td><form action="/SECA-SUMA/FrontEnd/src/Modali/Brisanje/povrsinaObrisi.php" method="POST"><input type="hidden" name="povrsinaID" value='.$povrsinaID.'><input class="input-slika" type="image"src="/SECA-SUMA/FrontEnd/Assets/trash-can.png" name="ObrisiSecu"></form></td>';
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
<div class="seca__formDodajOtvori"><?php include $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Modali/DodajNovo/povrsina__dodajNovo.php"?></div>

    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?></footer>
</body>
<script src="povrsina.js"></script>
</html>