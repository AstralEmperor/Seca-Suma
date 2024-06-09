<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/DodajNovo/dodajNovo.css" type="text/css" rel="stylesheet">
    </head>
    <section class="dodajNovi">
        <form class="dodajNovi__form" action="/Seca-Suma/FrontEnd/src/Modali/Snimanje/trosakSnimanje.php" method="POST">
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
                    <label for="ukupanTrosak" class="label">Ukupan Trošak*</label>
                    <input name="ukupanTrosak" id="ukupanTrosak" type="number" class="input" placeholder="Ukupan Trošak" pattern="[0-9]{1,20}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 20 brojeva')" oninput="setCustomValidity('')"  required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="plate" class="label">Plate ($)*</label>
                    <input name="plate" id="plate" class="input" type="number" placeholder="Plate" pattern="[0-9]{1,8}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 8 brojeva')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="prevozniTrosak" class="label">Prevozni Trošak*</label>
                    <input name="prevozniTrosak" id="prevozniTrosak" class="input" type="number" pattern="[0-9]{1,8}" placeholder="Prevozni Trošak" oninvalid="this.setCustomValidity('Molimo vas unesite datum')" oninput="setCustomValidity('')" required>
                </div>
                <div class="dodajNovi__inputWrap">
                    <label for="masineTrosak" class="label">Masine Trošak*</label>
                    <input name="masineTrosak" id="masineTrosak" class="input" type="number" placeholder="Troškovi pri radu" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required>
                </div> 

            </div>
            <div class="dodajNovi__addBtnWrap">
              <button class="button dodajNovi__snimiBtn" name="submit" type="submit">UPIŠI</button>
            </div>
        </form>
    </section>