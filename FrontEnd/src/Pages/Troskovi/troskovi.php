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
    <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
    <link href="/SECA-SUMA/FrontEnd/src/Pages/Troskovi/troskovi.css" type="text/css" rel="stylesheet">
    <title>Potrošnja</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Partials/Header/header.php"?>
    <section class="troskovi">
    <div class="troskovi__h1Wrap">
        <h1 class="troskovi__h1">Troškovi</h1>
    </div>
    <table class="table troskovi__table">
        <thead class="troskovi__thead">
            <tr class="troskovi__headTr">
                <th>ID</th>
                <th>Vrsta Drveta</th>
                <th>Vrsta Rada</th>
                <th>Cena($)</th>
                <th>Edituj</th>
                <th>Obriši</th>
            </tr>
        </thead>
        <tbody class="troskovi__tableBody">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Classes/konekcijaTroskovi.php"?>
        </tbody>
    </table>
</section>
    <footer><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Partials/Footer/footer.php"?></footer>
</body>
</html>