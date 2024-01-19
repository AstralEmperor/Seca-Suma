<?php

class Transakcija{

    private $OtvorenaKonekcija;
    private $VerzijaMySQLNaredbi;
    
    // konstruktor
    public function __construct($NovaOtvorenaKonekcija)
    {
        $this->OtvorenaKonekcija = $NovaOtvorenaKonekcija;
        $this->VerzijaMySQLNaredbi = $NovaOtvorenaKonekcija->VerzijaMySQLNaredbi;
    }
    // uzima trenutnu verziju PHP
    public function DajVerzijuMySQL()
    {
        return $this->VerzijaMySQLNaredbi;
    }
    // zapozicnje transakciju
    public function ZapocniTransakciju()
    {
        if($this->VerzijaMySQLNaredbi=="mysqli")
        {
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET AUTOCOMMIT=0");
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "START TRANSACTION");
        }
        else{
            mysql_query("SET AUTOCOMMIT=0");
            mysql_query("START TRANSACTION");
        }
    }
    // proverava gresku prilikom transakcije i vraca je 
    public function ProveriGresku()
    {
        if($this->VerzijaMySQLNaredbi == "mysqli"){
            $greska = mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        }
        else{
            $greska = mysql_error();
        }
      return $greska;
    }
    // ponistava transakciju
    public function PonistiTransakciju()
    {
        if ($this->VerzijaMySQLNaredbi=="mysqli"){
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "ROLLBACK");
        }
        else{
            mysql_query("ROLLBACK");
        }
    }
    // Zatvaranje transakcije nakon njenog izvrsenja
    public function ZavrsiTransakciju($UtvrdjenaGreska){
     if($this->VerzijaMySQLNaredbi=="mysqli"){
        if(empty($UtvrdjenaGreska)){
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "COMMIT");
        }
        else{
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB,"ROLLBACK");
        }
     }
     else{
        if(empty($UtvrdjenaGreska)){
            mysql_query("COMMIT");
        }
        else{
            mysql_query("ROLLBACK");
        }
     }
    }
 }
?>