<?php
    session_start();
    session_unset();
    session_destroy();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
	   // proverava informacije u sesiji za korisnika
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako korisnik nije prijavljen, vraca ga na pocetnu stranicu
				if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="style.css" type="text/css" rel="stylesheet">
    <link href="welcome.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,800;1,300;1,400;1,600;1,800&display=swap" rel="stylesheet">
    <title>Početna strana</title>
</head>
<body class="glavniKontejner">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Header/header.php"?>
        <section class="index">
            <aside class="leviMeni">
                <?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/LeviMeni/leviMeni.php"?>
            </aside>
            <img src="/SECA-SUMA/FrontEnd/Assets/food-cutting-pic1.jpg" alt="woodcutting.jpg">
        </section>
         <footer class="footer"><?php require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/FrontEnd/src/Delovi/Footer/footer.php"?>
        </footer>
</body>
</html>