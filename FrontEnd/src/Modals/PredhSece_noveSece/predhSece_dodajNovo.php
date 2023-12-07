<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Classes/prethSeceClass.php';
?>
<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modals/PredhSece_noveSece/predhSece_dodajNovo.css" type="text/css" rel="stylesheet">
    </head>
    <section class="addNew">
        <form class="addNew__form" action="" method="POST">
            <div class="addNew__h3Wrap">
                 <h3>Unesi Odradjenu Seču</h1>
            </div>
            <!-- CANCEL FORM -->
            <div class="addNew__cancelWrap">
                <button class="addNew__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <!-- INPUT FIELD -->
            <div class="addNew__inputContainer">
                <div class="addNew__inputWrap">
                    <label for="vrstadrveta" class="label">Vrsta Drveta</label>
                    <input name="vrstadrveta" class="input" id="vrstadrveta" type="text" required placeholder="Naziv">
                </div>
                <div class="addNew__inputWrap">
                    <label for="povrsina" class="label">Površina Šume(m3)</label>
                    <input name="povrsina" id="povrsina" class="input" type="text" required placeholder="Površina">
                </div>
                <div class="addNew__inputWrap">
                    <label for="datum" class="label">Datum</label>
                    <input name="datum" id="datum" class="input" type="date" required>
                </div>
                <div class="addNew__inputWrap">
                    <label for="vrstaRada" class="label">Vrsta Rada</label>
                    <input name="vrstaRada" id="vrstaRada" class="input" type="text"  placeholder="Vrsta rada" required>
                </div>
                <div class="addNew__inputWrap">
                    <label for="zarada" class="label">Ukupna zarada</label>
                    <input name="zarada" id="zarada" class="input" type="text"  placeholder="Zarada" required>
                </div>
                <div class="addNew__inputWrap">
                    <label for="troskovi" class="label">Troškovi</label>
                    <input name="troskovi" id="troskovi" class="input" type="text"  placeholder="Troškovi u radu" required>
                </div>
            </div>
            <div class="addNew__addBtnWrap">
              <button class="button addNew__addBtn" name="submit" type="submit">UPIŠI</button>
            </div>
        </form>
    </section>