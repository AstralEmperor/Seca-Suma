
<?php
    

    session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    // proverava informacije u sesiji za korisnika
    $korisnik=$_SESSION["korisnik"];
    // ako korisnik nije prijavljen, vraca ga na pocetnu stranicu
    if (!isset($korisnik)){
        header ('Location:/Seca-Suma/index.php');
    }	

    $ukupanTrosak=$_POST['ukupanTrosak'];
    $plate=$_POST['plate'];
    $prevozniTrosak=$_POST['prevozniTrosak']; 
    $masineTrosak=$_POST['masineTrosak'];
	   
	   //KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    //proverava da li je konekcija uspesna
	if ($KonekcijaObject->konekcijaDB)
    {	
            
            // pozivanje funkcije procedure
            require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBTrosak.php";
            $TrosakObject = new DBTrosak($KonekcijaObject, 'trosak');
            $TrosakObject->ukupanTrosak=$ukupanTrosak;
            $TrosakObject->plate=$plate;
            $TrosakObject->prevozniTrosak=$prevozniTrosak;
            $TrosakObject->masineTrosak=$masineTrosak;
            $TrosakObject->DodajNoviTrosak();
                
            $UtvrdjenaGreska=$greska;
        }else{
            $UtvrdjenaGreska = "Ne mozete se uneti Trosak!";
        }
      // ZATVARANJE KONEKCIJE KA DBMS
	  $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	
	if ($UtvrdjenaGreska){
	 echo "Greska $UtvrdjenaGreska";
     }	
	 else
	 {
		//  "Sacuvani troskovi";	
        header("Location:/Seca-Suma/FrontEnd/src/Stranice/Trosak/trosakAdmin.php");
	 }
		
	  
?>