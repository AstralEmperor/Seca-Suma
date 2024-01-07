<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Classes/prethSeceClass.php';
?>
<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modals/PredhSece_noveSece/predhSece_dodajNovo.css" type="text/css" rel="stylesheet">
    </head>
    <section class="dodajNovi">
        <form class="dodajNovi__form" action="" method="POST">
            <div class="dodajNovi__h3Wrap">
                 <h3>Unesi Odradjenu Seču</h1>
            </div>
            <!-- CANCEL FORM -->
            <div class="dodajNovi__cancelWrap">
                <button class="dodajNovi__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <!-- INPUT FIELD -->
            <div class="dodajNovi__inputContainer">
                <div class="dodajNovi__inputWrap">
                    <label for="vrstadrveta" class="label">Vrsta Drveta</label>
                    <input name="vrstadrveta" class="input" id="vrstadrveta" type="text" required placeholder="Naziv" pattern="[A-Za-Z]{3,30}" oninvalid="this.setCustomValidity('Molimo vas unesite 3 do 30 karaktera')" oninput="setCustomValidity('')">
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="povrsina" class="label">Površina Šume(m3)</label>
                    <input name="povrsina" id="povrsina" class="input" type="text" required placeholder="Površina" pattern="[0-9]{1,6}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 6 brojeva')" oninput="setCustomValidity('')">
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="datum" class="label">Datum</label>
                    <input name="datum" id="datum" class="input" type="date" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="vrstaRada" class="label">Vrsta Rada</label>
                    <select name="vrstaRada" id="vrstaRada" class="input"required>
                        <option value="">--Vrsta rada--</option>
                    </select>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="zarada" class="label">Ukupna zarada</label>
                    <input name="zarada" id="zarada" class="input" type="text"  placeholder="Zarada" required pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')">
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="troskovi" class="label">Troškovi</label>
                    <input name="troskovi" id="troskovi" class="input" type="text"  placeholder="Troškovi u radu" required pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="dodajNovi__addBtnWrap">
              <button class="button dodajNovi__addBtn" name="submit" type="submit">UPIŠI</button>
            </div>
        </form>
    </section>