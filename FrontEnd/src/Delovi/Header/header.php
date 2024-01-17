<meta charset="UTF-8">
<head>
   <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
   <link href="/SECA-SUMA/FrontEnd/src/Delovi/Header/header.css" type="text/css" rel="stylesheet">
</head>
<nav class="header">
   <ul class="header__ul">
        <li class="header__listItem"><a href="/SECA-SUMA/index.php">Početna</a></li>
        <li class="header__listItem"><a href="/SECA-SUMA/FrontEnd/src/Stranice/ZakazaneSece/zakazaneSece.php">Zakazane Seče</a></li>
        <li class="header__listItem"><a href="/SECA-SUMA/FrontEnd/src/Stranice/Mesta/mesta.php">Seče po mestima</a></li>
   </ul>
   <ul class="header__ul">
      <li class="header__listItem"><a id="login__link" href="">Uloguj Se</a></li>
   </ul>
</nav>
<hr class="hr">
<div class="login__wrapper"><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Login/login.php"?></div>
<script src="/SECA-SUMA/FrontEnd/src/Delovi/Header/header.js"></script>