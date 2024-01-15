<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/zakazaneSeceClass.php';
?>
<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/ZakazaneSece_noveSece/zakazaneSece_dodajNovo.css" type="text/css" rel="stylesheet">
    </head>
    <section class="dodajNovi">
        <form class="dodajNovi__form" action="" method="POST">
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
                    <label for="Vrstadrveta" class="label">Vrsta Drveta</label>
                    <input name="Vrstadrveta" id="Vrstadrveta" type="text" class="input" placeholder="Vrsta Drveta" pattern="[A-Za-z]{1,20}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 20 karaktera')" oninput="setCustomValidity('')"  required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="Povrsina" class="label">Površina Šume(m3)</label>
                    <input name="Povrsina" id="Povrsina" class="input" type="text" placeholder="Površina" pattern="[0-9]{1,6}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 6 brojeva')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="Datum" class="label">Datum</label>
                    <input name="Datum" id="Datum" class="input" type="date" min="2024-01-01" oninvalid="this.setCustomValidity('Molimo vas unesite datum')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="Neto" class="label">Neto</label>
                    <input name="Neto" id="Neto" class="input" type="text" placeholder="Zarada" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="Mesto" class="label">Mesto</label>
                    <input name="Mesto" id="Mesto" class="input" type="text"  placeholder="Mesto" required pattern="[A-Za-z]{1,20}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 20 karaktera')" oninput="setCustomValidity('')">
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="Trosak" class="label">Troškovi</label>
                    <input name="Trosak" id="Trosak" class="input" type="text"  placeholder="Troškovi u radu" required pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="dodajNovi__addBtnWrap">
              <button class="button dodajNovi__addBtn" name="submit" type="submit">UPIŠI</button>
            </div>
        </form>
    </section>