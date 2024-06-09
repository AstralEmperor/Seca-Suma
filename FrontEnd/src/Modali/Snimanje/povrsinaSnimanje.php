
<?php
    

    session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    // proverava informacije u sesiji za korisnika
    $korisnik=$_SESSION["korisnik"];
    // ako korisnik nije prijavljen, vraca ga na pocetnu stranicu
    if (!isset($korisnik)){
        header ('Location:/Seca-Suma/index.php');
    }	

    $povrsinaZaSecu=$_POST['povrsinaZaSecu'];
    $ukupnaPovrsina=$_POST['ukupnaPovrsina'];
    $mladice=$_POST['mladice']; 
    $praznina=$_POST['praznina'];
	   
	   //KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    //proverava da li je konekcija uspesna
	if ($KonekcijaObject->konekcijaDB)
    {	
            
            // pozivanje funkcije procedure
            require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBPovrsina.php";
            $PovrsinaObject = new DBPovrsina($KonekcijaObject, 'povrsina');
            $PovrsinaObject->povrsinaZaSecu=$povrsinaZaSecu;
            $PovrsinaObject->ukupnaPovrsina=$ukupnaPovrsina;
            $PovrsinaObject->mladice=$mladice;
            $PovrsinaObject->praznina=$praznina;
            $PovrsinaObject->DodajNovuPovrsinu();
                
            $UtvrdjenaGreska=$greska;
        }else{
            $UtvrdjenaGreska = "Ne mozete se uneti Povrsinu!";
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
        header("Location:/Seca-Suma/FrontEnd/src/Stranice/Povrsina/povrsinaAdmin.php");
	 }
		
	  
?>