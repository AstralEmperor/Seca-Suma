<?php
    session_start();

    $korisnik=$_SESSION["korisnik"];

        if(!isset($korisnik)){
            header ('Location:/Seca-Suma/index.php');
        }

        $StariSecaID = $_POST['SecaID'];

        // ostvaruje konekciju
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
        $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
        $KonekcijaObject->connect();
        $db_handle = $KonekcijaObject->konekcijaMYSQL;
        $bazapodataka = $KonekcijaObject->KompletanNazivBazePodataka;
        $UspehKonekcijeNaBazu = $KonekcijaObject -> konekcijaDB;

        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

        // preuzima podatke klase mesto
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

        // Preuzima stare vrednosti iz izabrane Sece
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSece.php";
        $ZakazaneSeceObject = new DBZakazaneSece($KonekcijaObject, 'zakazanaseca');
        $ZakazaneSeceObject-> UcitajSecuPoId($StariSecaID);
        $KolekcijaZapisaZakazanihSeca = $ZakazaneSeceObject->Kolekcija;
        $UkupanBrojZapisaZakazanihSeca = $ZakazaneSeceObject->BrojZapisa;

        if($UkupanBrojZapisaZakazanihSeca > 0){
            $row=0;
            $StariSecaID=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row, 0);
            $StaraVrstaDrveta=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,1);
            $StaraPovrsinaSumeID=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,2);
            $StariDatum=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,3);
            $StariNeto=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,4);
            $StariTrosak=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,5);
            $StaroMesto=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,6);
            $StaroPlacenoUnapred=$ZakazaneSeceObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,7);

        }
?>

<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/Izmena/editovanjeSeca.css" type="text/css" rel="stylesheet">
    </head>
    <section class="edituj">
        <form class="edituj__form" action="/Seca-Suma/FrontEnd/src/Modali/Izmena/izmenaZakazaneSece.php" method="POST">
        <input type="hidden" name="SecaID" value="<?php echo $StariSecaID;?>">
         <input type="hidden" name="StariSecaID" value="<?php echo $StariSecaID;?>">
            <!-- CANCEL FORM -->
            <div class="edituj__cancelWrap">
                <button class="edituj__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <div class="edituj__h3Wrap">
                 <h3>Promeni Zakazanu Seču</h1>
            </div>
            <!-- INPUT FIELD -->
            <div class="edituj__inputContainer">
                <div class="edituj__inputWrap">
                    <label for="VrstaDrveta" class="label">Vrsta Drveta*</label>
                    <input name="VrstaDrveta" id="VrstaDrveta" type="text" class="input" placeholder="Vrsta Drveta" pattern="[A-Za-z]{1,20}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 20 karaktera')" oninput="setCustomValidity('')"  required value="<?php echo $StaraVrstaDrveta; ?>">
                </div>
                <div class="edituj__inputWrap">
                    <label for="PovrsinaSumeID" class="label">Površina ŠumeID*</label>
                    <select type="combobox" name="PovrsinaSumeID" id="PovrsinaSumeID" class="input" placeholder="--Povrsina--" required>
                        <?php
                            if ($UkupanBrojZapisaPovrsina>0) 
                            {
                                echo "<option value=\"$StaraPovrsinaSumeID\">$StaraPovrsinaSumeID</option>";
                                for ($brojacPovrsina = 0; $brojacPovrsina < $UkupanBrojZapisaPovrsina; $brojacPovrsina++) 
                                    {
                                        $Povrsina =$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaPovrsina, $brojacPovrsina, 0);							
                                        echo "<option value=\"$Povrsina\">$Povrsina</option>";						
                                    }                         
                            }  
                        ?>         
                    </select>
                </div>
                <div class="edituj__inputWrap">
                    <label for="Datum" class="label">Datum*</label>                    
                    <input name="Datum" id="Datum" class="input" type="date" min="2024-01-01" oninvalid="this.setCustomValidity('Molimo vas unesite validan datum')" oninput="setCustomValidity('')" required value="<?php echo $StariDatum; ?>">
                </div>
                <div class="edituj__inputWrap">
                    <label for="Neto" class="label">Neto($)*</label>                  
                    <input name="Neto" id="Neto" class="input" type="text" placeholder="Zarada" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required value="<?php echo $StariNeto; ?>">                    
                </div>
                <div class="edituj__inputWrap">
                    <label for="TrosakPriRaduID" class="label">TroškoviID*</label>                   
                   <select type="combobox" name="TrosakPriRaduID" id="TrosakPriRaduID" class="input" placeholder="--Trošak--" required>
                        <?php
                            if ($UkupanBrojZapisaTroskova>0) 
                            {
                                echo "<option value=\"$StariTrosak\">$StariTrosak</option>";
                                for ($brojacTroskova = 0; $brojacTroskova < $UkupanBrojZapisaTroskova; $brojacTroskova++) 
                                    {
                                        $Trosak =$TrosakObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaTroskova, $brojacTroskova, 0);								
                                        echo "<option value=\"$Trosak\">$Trosak</option>";						
                                    }                       
                            }  
                        ?>         
                    </select>
                </div>
                <div class="edituj__inputWrap">
                    <label for="Mesto" class="label">Mesto*</label>                  
                        <select type="combobox" name="Mesto" id="Mesto" class="input" placeholder="--Mesto--" required>
                        <?php
                            if ($UkupanBrojZapisaMesta>0) 
                            {
                                echo "<option value=\"$StaroMesto\">$StaroMesto</option>";
                                for ($brojacMesta = 0; $brojacMesta < $UkupanBrojZapisaMesta; $brojacMesta++) 
                                    {
                                        $Mesto =$MestoObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaMesta, $brojacMesta, 0);				
                                        $UkupanBrojSeca=$MestoObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaMesta, $brojacMesta, 1);				
                                        echo "<option value=\"$Mesto\">$Mesto</option>";						
                                    }                         
                            }  
                        ?>         
                    </select>
                </div>
                <div class="edituj__inputWrap">
                    <label for="PlacenoUnapred" class="label">Placeno Unapred($)</label>                 
                    <input name="PlacenoUnapred" id="PlacenoUnapred" class="input" type="text" placeholder="Troškovi u radu" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" value="<?php echo $StaroPlacenoUnapred; ?>">
                 </div>
            </div>
            <div class="edituj__addBtnWrap">
              <button class="button edituj__snimiBtn" name="submit" type="submit" enctype="multipart/form-data">SNIMI IZMENU</button>
            </div>
        </form>
    </section>
