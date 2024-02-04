<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/ZakazaneSece_noveSece/zakazaneSece_dodajNovo.css" type="text/css" rel="stylesheet">
    </head>
    <section class="dodajNovi">
        <form class="dodajNovi__form" action="/Seca-Suma/FrontEnd/src/Modali/Snimanje/snimanjeSP.php" method="POST">
            <div class="dodajNovi__h3Wrap">
                 <h3>Unesi Zakazanu Seču</h1>
            </div>
            <!-- CANCEL FORM -->
            <div class="dodajNovi__cancelWrap">
                <button class="dodajNovi__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <!-- INPUT FIELD -->
            <div class="dodajNovi__inputContainer">
                <div class="dodajNovi__inputWrap">
                    <label for="vrstaDrveta" class="label">Vrsta Drveta*</label>
                    <input name="vrstaDrveta" id="vrstaDrveta" type="text" class="input" placeholder="Vrsta Drveta" pattern="[A-Za-z]{1,20}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 20 karaktera')" oninput="setCustomValidity('')"  required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="povrsinaSume" class="label">Površina Šume(m3)*</label>
                    <input name="povrsinaSume" id="povrsinaSume" class="input" type="text" placeholder="Površina" pattern="[0-9]{1,6}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 6 brojeva')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="datum" class="label">Datum*</label>
                    <input name="datum" id="datum" class="input" type="date" min="2024-01-01" oninvalid="this.setCustomValidity('Molimo vas unesite datum')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="neto" class="label">Neto($)*</label>
                    <input name="neto" id="neto" class="input" type="text" placeholder="Zarada" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="trosak" class="label">Troškovi($)*</label>
                    <input name="trosak" id="trosak" class="input" type="text"  placeholder="Troškovi u radu" required pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')">
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="mesto" class="label">Mesto*</label>
                    <select type="combobox" name="mesto" id="mesto" class="input" placeholder="--Mesto--" required>
                    <?php
                            if ($UkupanBrojZapisa>0) 
                            {		
                                for ($brojacMesta = 0; $brojacMesta < $UkupanBrojZapisa; $brojacMesta++) 
                                    {
                                        $Mesto =$MestoObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $brojacMesta, 0);				
                                        $UkupanBrojSeca=$MestoObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $brojacMesta, 1);				
                                        echo "<option value=\"$Mesto\">$Mesto</option>";						
                                    }                         
                            }  
                        ?>         
                    </select>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="placenoUnapred" class="label">Placeno Unapred($)</label>
                    <input name="placenoUnapred" id="placenoUnapred" class="input" type="text" placeholder="Troškovi u radu" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" value="0">
                </div>
            </div>
            <div class="dodajNovi__addBtnWrap">
              <button class="button dodajNovi__snimiBtn" name="submit" type="submit">UPIŠI</button>
            </div>
        </form>
    </section>