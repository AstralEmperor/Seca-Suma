<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/DodajNovo/dodajNovo.css" type="text/css" rel="stylesheet">
    </head>
    <section class="dodajNovi">
        <form class="dodajNovi__form" action="/Seca-Suma/FrontEnd/src/Modali/Snimanje/povrsinaSnimanje.php" method="POST">
            <div class="dodajNovi__h3Wrap">
                 <h3>Unesi sve troškove pri seči</h1>
            </div>
            <!-- CANCEL FORM -->
            <div class="dodajNovi__cancelWrap">
                <button class="dodajNovi__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <!-- INPUT FIELD -->
            <div class="dodajNovi__inputContainer">
                <div class="dodajNovi__inputWrap">
                    <label for="povrsinaZaSecu" class="label">Povrsina za seču(m3)*</label>
                    <input name="povrsinaZaSecu" id="povrsinaZaSecu" type="number" class="input" placeholder="Povrsina za seču" pattern="[0-9]{1,20}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 20 brojeva')" oninput="setCustomValidity('')"  required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="ukupnaPovrsina" class="label">Ukupna površina (m3)*</label>
                    <input name="ukupnaPovrsina" id="ukupnaPovrsina" class="input" type="number" placeholder="Plate" pattern="[0-9]{1,8}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 8 brojeva')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="mladice" class="label">Mladice Površina (m3)*</label>
                    <input name="mladice" id="mladice" class="input" type="number" placeholder="Površina mladih stabala" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required>
                </div> 
                <div class="dodajNovi__inputWrap">
                    <label for="praznina" class="label">Praznina (m3)*</label>
                    <input name="praznina" id="praznina" class="input" type="number" pattern="[0-9]{1,8}" placeholder="Površina bez stabala" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 9 brojeva')" oninput="setCustomValidity('')" required>
                </div>
            </div>
            <div class="dodajNovi__addBtnWrap">
              <button class="button dodajNovi__snimiBtn" name="submit" type="submit">UPIŠI</button>
            </div>
        </form>
    </section>