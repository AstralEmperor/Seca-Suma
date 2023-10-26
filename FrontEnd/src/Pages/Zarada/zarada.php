<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/php-apps/SEČA-ŠUMA/style.css" type="text/css" rel="stylesheet">
    <link href="/php-apps/SEČA-ŠUMA/FrontEnd/src/Pages/Zarada/zarada.css" type="text/css" rel="stylesheet">
    <title>Zarada</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/php-apps/SEČA-ŠUMA/FrontEnd/src/Partials/Header/header.php"?>
<section class="zarada">
    <div class="zarada__h1Wrap">
        <h1 class="zarada__h1">Prethodna Zarada</h1>
    </div>
    <table class="table zarada__table">
        <thead class="zarada__thead">
            <tr class="zarada__headTr">
                <th>ID</th>
                <th>Vrsta Drveta</th>
                <th>Površina Šume(m3)</th>
                <th>Bruto($)</th>
                <th>Otpad($)</th>
                <th>Neto($)</th>
                <th>Edituj</th>
                <th>Obriši</th>
            </tr>
        </thead>
        <tbody class="zarada__tableBody">
            <?php  include $_SERVER['DOCUMENT_ROOT'] . "/php-apps/SEČA-ŠUMA/BackEnd/Classes/konekcijaZarada.php" ?>
        </tbody>
    </table>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/php-apps/SEČA-ŠUMA/FrontEnd/src/Partials/Footer/footer.php"?></footer>
</body>
</html>