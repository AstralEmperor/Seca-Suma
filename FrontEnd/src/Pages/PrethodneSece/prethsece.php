<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/SEČA-ŠUMA/style.css" type="text/css" rel="stylesheet">
    <link href="/SEČA-ŠUMA/FrontEnd/src/Pages/PrethodneSece/prethsece.css" type="text/css" rel="stylesheet">
    <title>Zarada</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SEČA-ŠUMA/FrontEnd/src/Partials/Header/header.php"?>
<section class="zarada">
    <div class="zarada__h1Wrap">
        <h1 class="zarada__h1">Evidencija Seča Šuma</h1>
    </div>
        <div class="zarada__optionsWrap">
        <div class="zarada__addBtnWrap">
                <button class="zarada__addNew button">DODAJ IZVRŠENU SEČU</button>
            </div>
            <div class="zarada__pretraga">
               <label for="filterSece">Pretraga</label>
               <div class="zarada__pretragaBar">
                    <Input name="filterSece" id="filterSece" class="zarada__Filter input" placeholder="Unesi vrednost">
                    <button class="zarada__filterBtn button"><img src="/SEČA-ŠUMA/FrontEnd/Assets/Search_icon.png" alt="search.png"></button>
               </div>
            </div>
        </div>
    <table class="table zarada__table">
        <thead class="zarada__thead">
            <tr class="zarada__headTr">
                <th>ID</th>
                <th>Vrsta Drveta</th>
                <th>Površina Šume(m3)</th>
                <th>Datum</th>
                <th>Neto($)</th>
                <th>Edituj</th>
                <th>Obriši</th>
            </tr>
        </thead>
        <tbody class="zarada__tableBody">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/SEČA-ŠUMA/BackEnd/Classes/konekcijaPrethodneSece.php"?>
        </tbody>
    </table>
    <div class="zarada__formShow"><?php include $_SERVER['DOCUMENT_ROOT'] . "/SEČA-ŠUMA/FrontEnd/src/Modals/PredhSece_noveSece/predhSece_dodajNovo.php"?></div>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SEČA-ŠUMA/FrontEnd/src/Partials/Footer/footer.php"?></footer>
</body>
<script src="prethsece.js"></script>
</html>