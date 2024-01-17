
 <?php
    

    session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
    // proverava informacije u sesiji za korisnika
    $korisnik=$_SESSION["korisnik"];
    // ako korisnik nije prijavljen, vraca ga na pocetnu stranicu
    if (!isset($korisnik)){
        header ('Location:/Seca-Suma/index.php');
    }	

    $VrstaDrveta=$_POST['vrstaDrveta'];
    $PovrsinaSume=$_POST['povrsinaSume'];
    $Datum=$_POST['datum']; 
    $Neto=$_POST['neto'];
    $Mesto=$_POST['mesto']; 
    $Trosak=$_POST['trosak'];
    $PlacenoUnapred=$_POST['placenoUnapred'];  
	   
	   //KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    //proverava da li je konekcija uspesna
	if ($KonekcijaObject->konekcijaDB)
    {	
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTransakcija.php";
		$TransakcijaObject = new Transakcija($KonekcijaObject);
		$TransakcijaObject->ZapocniTransakciju();
		
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSeceSP.php";
	    $ZakazaneSeceObject = new DBZakazaneSece($KonekcijaObject, 'zakazanaseca');
        $ZakazaneSeceObject->VrstaDrveta=$VrstaDrveta;
        $ZakazaneSeceObject->PovrsinaSume=$Datum;
        $ZakazaneSeceObject->Datum=$Datum;
        $ZakazaneSeceObject->Neto=$Neto;
        $ZakazaneSeceObject->Mesto=$Mesto;
        $ZakazaneSeceObject->Trosak=$Trosak;
        $ZakazaneSeceObject->PlacenoUnapred=$PlacenoUnapred;
        $greska1 = $ZakazaneSeceObject->DodajNovuSecu();
		
		// inkrement broja studenata kroz klasu DBSmer
        // require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBMesta.php";
        // $MestoObject= new DBMesto($KonekcijaObject,'mesto');
        // $greska2=$MestoObject->InkrementirajUkupanBrojSecaPoMestu($Mesto);
		
		//$UtvrdjenaGreska=$greska1 ili $greska2;
		$UtvrdjenaGreska=$greska1.$greska2;
		$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
        	
		}
      // ZATVARANJE KONEKCIJE KA DBMS
	  $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	
	if ($UtvrdjenaGreska) {
	echo "Greska $UtvrdjenaGreska";	
     }	
	 else
	 {
		//  "Sacuvana seca";	
        header("Location:/Seca-Suma/FrontEnd/src/Stranice/ZakazaneSece/zakazaneseceAdmin.php");
	 }
		
	  
      ?>