<meta charset="UTF-8">
<head>
   <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
   <link href="/SECA-SUMA/FrontEnd/src/Partials/Header/header.css" type="text/css" rel="stylesheet">
</head>
<nav class="header">
   <ul class="header__ul">
        <li class="header__listItem"><a href="/SECA-SUMA/index.php">Početna</a></li>
        <li class="header__listItem"><a href="/SECA-SUMA/FrontEnd/src/Pages/PrethodneSece/prethsece.php">Prethodne Seče</a></li>
        <li class="header__listItem"><a href="/SECA-SUMA/FrontEnd/src/Pages/Troskovi/troskovi.php">Troškovi</a></li>
   </ul>
   <ul class="header__ul">
      <li class="header__listItem"></li>
   </ul>
</nav>
<hr class="hr">
<div class="login__wrapper"><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Partials/Login/login.php"?></div>
<script src="/SECA-SUMA/FrontEnd/src/Partials/Header/header.js"></script>