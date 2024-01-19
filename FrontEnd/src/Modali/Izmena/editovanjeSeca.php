<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/Izmena/editovanjeSeca.css" type="text/css" rel="stylesheet">
    </head>
    <section class="edituj">
        <form class="edituj__form" action="/Seca-Suma/FrontEnd/src/Modali/Izmena/izmenaZakazaneSece.php" method="POST">
            <div class="edituj__h3Wrap">
                 <h3>Promeni Zakazanu Seču</h1>
            </div>
            <!-- CANCEL FORM -->
            <div class="edituj__cancelWrap">
                <button class="edituj__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <!-- INPUT FIELD -->
            <div class="edituj__inputContainer">
                <div class="edituj__inputWrap">
                    <label for="VrstaDrveta" class="label">Vrsta Drveta*</label>
                    <input name="VrstaDrveta" id="VrstaDrveta" type="text" class="input" placeholder="Vrsta Drveta" pattern="[A-Za-z]{1,20}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 20 karaktera')" oninput="setCustomValidity('')"  required value="'.$VrstaDrveta.'">

                </div>
                <div class="edituj__inputWrap">
                    <label for="PovrsinaSume" class="label">Površina Šume(m3)*</label>
                   
                    <input name="PovrsinaSume" id="PovrsinaSume" class="input" type="text" placeholder="Površina" pattern="[0-9]{1,6}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 6 brojeva')" oninput="setCustomValidity('')" required value="'.$Povrsina.'">
                    
                </div>
                <div class="edituj__inputWrap">
                    <label for="Datum" class="label">Datum*</label>
                    
                    <input name="Datum" id="Datum" class="input" type="date" min="2024-01-01" oninvalid="this.setCustomValidity('Molimo vas unesite validan datum')" oninput="setCustomValidity('')" required value="'.$Datum.'">
 
                </div>
                <div class="edituj__inputWrap">
                    <label for="Neto" class="label">Neto($)*</label>
                   
                    <input name="Neto" id="Neto" class="input" type="text" placeholder="Zarada" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required value="'.$Neto.'">
                    
                </div>
                <div class="edituj__inputWrap">
                    <label for="Trosak" class="label">Troškovi($)*</label>
                    
                    <input name="Trosak" id="Trosak" class="input" type="text"  placeholder="Troškovi u radu" required pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" value="'.$Troskovi.'">
                   
                </div>
                <div class="edituj__inputWrap">
                    <label for="Mesto" class="label">Mesto*</label>
                    
                        <select type="combobox" name="Mesto" id="Mesto" class="input" placeholder="--Mesto--" required value="'.$Mesto.'">  
                    
                    </select>
                </div>
                <div class="edituj__inputWrap">
                    <label for="PlacenoUnapred" class="label">Placeno Unapred($)</label>
                   
                    <input name="PlacenoUnapred" id="PlacenoUnapred" class="input" type="text" placeholder="Troškovi u radu" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" value="'.$PlacenoUnapred.'">
                    </div>
            </div>
            <div class="edituj__addBtnWrap">
              <button class="button edituj__snimiBtn" name="submit" type="submit">PROMENI</button>
            </div>
        </form>
    </section>