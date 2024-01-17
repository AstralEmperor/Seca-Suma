
<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/DodajMesta/mesta_dodajNovo.css" type="text/css" rel="stylesheet">
    </head>
    <section class="dodajNovi">
        <form class="dodajNovi__form" action="" method="POST">
            <div class="dodajNovi__h3Wrap">
                 <h3>Unesi Mesto</h1>
            </div>
            <!-- CANCEL FORM -->
            <div class="dodajNovi__cancelWrap">
                <button class="dodajNovi__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <!-- INPUT FIELD -->
            <div class="dodajNovi__inputContainer">
                <div class="dodajNovi__inputWrap">
                    <label for="mesto" class="label">Mesto*</label>
                    <input name="mesto" id="mesto" class="input" type="text"  placeholder="Troškovi u radu" required pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')">
                </div>
                <div class="dodajNovi__inputWrap">
                    <input type="hidden" name="mesto" id="mesto" class="input" value="0" required pattern="[0]{1}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 brojeva')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="dodajNovi__addBtnWrap">
              <button class="button dodajNovi__addBtn" name="submit" type="submit">UPIŠI</button>
            </div>
        </form>
    </section>