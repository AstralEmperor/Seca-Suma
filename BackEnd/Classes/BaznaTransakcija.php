<?php

class Transakcija{

    private $OtvorenaKonekcija;
    private $VerzijaMYSQLNaredbi;


    public function __construct($NovaOtvorenaKonekcija)
    {
        $this->OtvorenaKonekcija = $NovaOtvorenaKonekcija;
        $this->VerzijaMYSQLNaredbi = $NovaOtvorenaKonekcija->VerzijaMYSQLNaredbi;
    }

    public function DajVerzijuMySQL()
    {
        return $this->VerzijaMySQLNaredbi;
    }

    public function ZapocniTransakciju()
    {
        if($this->VerzijaMYSQLNaredbi == "mysqli")
        {
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET AUTOCOMMIT=0");
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "START TRANSACTION");
        }
        else{
            mysql_query("SET AUTOCOMMIT = 0");
            mysql_query("START TRANSACTION");
        }
    }

    public function ProveriGresku()
    {
        if($this->VerzijaMYSQLNaredbi == "mysqli"){
            $greska = mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        }
        else{
            $greska = mysql_error();
        }
      return $greska;
    }

    public function PonistiTransakciju()
    {
        if ($this->VerzijaMYSQLNaredbi == "mysqli"){
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "ROLLBACK");
        }
        else{
            mysql_query("ROLLBACK");
        }
    }

    public function ZavrsiTransakciju($UtvrdjenaGreska){
     if($this->VerzijaMYSQLNaredbi == "mysqli"){
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