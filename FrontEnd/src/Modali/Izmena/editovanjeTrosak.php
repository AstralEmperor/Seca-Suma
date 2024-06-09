<?php
    session_start();

    $korisnik=$_SESSION["korisnik"];

        if(!isset($korisnik)){
            header ('Location:/Seca-Suma/index.php');
        }

        $StariSecaID = $_POST['trosakID'];

        // ostvaruje konekciju
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
        $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
        $KonekcijaObject->connect();
        $db_handle = $KonekcijaObject->konekcijaMYSQL;
        $bazapodataka = $KonekcijaObject->KompletanNazivBazePodataka;
        $UspehKonekcijeNaBazu = $KonekcijaObject -> konekcijaDB;

        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

        // Preuzima stare vrednosti iz izabrane Trosak
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBTrosak.php";
        $TrosakObject = new DBTrosak($KonekcijaObject, 'trosak');
        $TrosakObject-> UcitajSecuPoId($StariSecaID);
        $KolekcijaZapisaZakazanihSeca = $TrosakObject->Kolekcija;
        $UkupanBrojZapisaZakazanihSeca = $TrosakObject->BrojZapisa;

        if($UkupanBrojZapisaZakazanihSeca > 0){
            $row=0;
            $StariTrosakID=$TrosakObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row, 0);
            $StariUkupanTrosak=$TrosakObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,1);
            $StarePlate=$TrosakObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,2);
            $StariPrevozniTrosak=$TrosakObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,3);
            $StariMasinskiTrosak=$TrosakObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,4);

        }
?>

<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/Izmena/editovanjeSeca.css" type="text/css" rel="stylesheet">
    </head>
    <section class="edituj">
        <form class="edituj__form" action="/Seca-Suma/FrontEnd/src/Modali/Izmena/izmenaTrosak.php" method="POST">
        <input type="hidden" name="trosakID" value="<?php echo $StariTrosakID;?>">
         <input type="hidden" name="stariTrosakID" value="<?php echo $StariTrosakID;?>">
            <!-- CANCEL FORM -->
            <div class="edituj__cancelWrap">
                <button class="edituj__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <div class="edituj__h3Wrap">
                 <h3>Promeni Troškove seče</h1>
            </div>
            <!-- INPUT FIELD -->
            <div class="edituj__inputContainer">
                <div class="edituj__inputWrap">
                    <label for="ukupanTrosak" class="label">Ukupan Trošak*</label>
                    <input name="ukupanTrosak" id="ukupanTrosak" type="number" class="input" placeholder="Ukupan Trošak" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')"  required value="<?php echo $StariUkupanTrosak; ?>">
                </div>
                <div class="edituj__inputWrap">
                    <label for="plate" class="label">Plate*</label>
                    <input name="plate" id="plate" class="input" type="number" placeholder="Plate" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required value="<?php echo $StarePlate; ?>">                  
                </div>
                <div class="edituj__inputWrap">
                    <label for="prevozniTrosak" class="label">Masine Trošak*</label>                    
                    <input name="prevozniTrosak" id="prevozniTrosak" class="input" type="number" placeholder="Masine Trošak" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required value="<?php echo $StariPrevozniTrosak; ?>">
                </div>
                <div class="edituj__inputWrap">
                    <label for="masineTrosak" class="label">Masine Trošak*</label>                  
                    <input name="masineTrosak" id="masineTrosak" class="input" type="text" placeholder="Masine Trošak" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required value="<?php echo $StariMasinskiTrosak; ?>">                    
                </div>
            </div>
            <div class="edituj__addBtnWrap">
              <button class="button edituj__snimiBtn" name="submit" type="submit" enctype="multipart/form-data">SNIMI IZMENU</button>
            </div>
        </form>
    </section>
