
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
    $PovrsinaSumeID=$_POST['PovrsinaSumeID'];
    $Datum=$_POST['datum']; 
    $Neto=$_POST['neto'];
    $Mesto=$_POST['mesto']; 
    $TrosakPriRaduID=$_POST['TrosakPriRaduID'];
    $PlacenoUnapred=$_POST['placenoUnapred'];  
	   
	   //KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";
    $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
    $KonekcijaObject->connect();
    //proverava da li je konekcija uspesna
	if ($KonekcijaObject->konekcijaDB)
    {	
        // Poslovna logika, proverava da li ima dozvoljen broj seca u jednom vremenskom roku
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/ProveraMesta.php";
        $UnosObject = new zakazanopomestima($KonekcijaObject, 'zakazanaseca');
        $dozvoljeneSece = $UnosObject->DaLiImaSlobodnihRezervacijaSeca($Mesto);
        if($dozvoljeneSece == "DA"){

            require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTransakcija.php";
            $TransakcijaObject = new Transakcija($KonekcijaObject);
            $TransakcijaObject->ZapocniTransakciju();
            
            // pozivanje funkcije procedure
            require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBZakazaneSeceSP.php";
            $ZakazaneSeceObject = new DBZakazaneSece($KonekcijaObject, 'zakazanaseca');
            $ZakazaneSeceObject->VrstaDrveta=$VrstaDrveta;
            $ZakazaneSeceObject->PovrsinaSumeID=$PovrsinaSumeID;
            $ZakazaneSeceObject->Datum=$Datum;
            $ZakazaneSeceObject->Neto=$Neto;
            $ZakazaneSeceObject->Mesto=$Mesto;
            $ZakazaneSeceObject->TrosakPriRaduID=$TrosakPriRaduID;
            $ZakazaneSeceObject->PlacenoUnapred=$PlacenoUnapred;
            $greska1 = $ZakazaneSeceObject->DodajNovuSecu();
                
            // inkrementacija broja seca kroz klasu Mesto
            require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBMesta.php";;
            $MestoObject = new DBMesto($KonekcijaObject, 'mesto');
            $greska2=$MestoObject->InkrementirajUkupanBrojSecaPoMestu($Mesto);
            
            // zatvaranje transakcije
            $UtvrdjenaGreska=$greska1.$greska2;
            $TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
        }else{
            $UtvrdjenaGreska = "Ne mozete uneti jos seca na zadatom mestu!";
        }
	  }
      // ZATVARANJE KONEKCIJE KA DBMS
	  $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	
	if ($UtvrdjenaGreska){
	 echo "Greska $UtvrdjenaGreska";
     }	
	 else
	 {
		//  "Sacuvana seca";	
        header("Location:/Seca-Suma/FrontEnd/src/Stranice/ZakazaneSece/zakazaneseceAdmin.php");
	 }
		
	  
?>