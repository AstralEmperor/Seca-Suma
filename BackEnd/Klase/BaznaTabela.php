<?php 
 
 class Tabela{


 public $OtvorenaKonekcija;
 public $NazivBazePodataka;
 public $NazivTabele;
 public $TipMYSQL;

 public $Kolekcija;
 public $BrojZapisa;
 public $PrviRedZapisa;
 public $ListaZapisa;

// konstruktor klase
 public function __construct($NovaOtvorenaKonekcija, $NoviNazivTabele) {
        $this->OtvorenaKonekcija = $NovaOtvorenaKonekcija;
        $this->NazivBazePodataka = $NovaOtvorenaKonekcija->KompletanNazivBazePodataka;
        $this->NazivTabele = $NoviNazivTabele;
        $this->TipMYSQL = $NovaOtvorenaKonekcija->VerzijaMySQLNaredbi;
 }

public function UcitajSve($KriterijumSortiranja)
    {
        $SQL = "select * from `".$this->$NazivBazePodataka."`.`".$this->NazivTabele."` ORDER BY ".$KriterijumSortiranja;

        if($this->TipMYSQL=="mysqli"){
            $this->Kolekcija = mysqli_query($this->$OtvorenaKonekcija->konekcijaDB, $SQL);
            $this->BrojZapisa = mysqli_num_rows($this->Kolekcija);
        }
        else{
            $this->Kolekcija = mysql_query($SQL);
            $this->BrojZapisa = mysql_num_rows($this->Kolekcija);
        }
    }

    public function UcitajSvePoUpitu($Upit)
    {
        if($this->TipMYSQL=="mysqli"){
            $this->Kolekcija = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $Upit);
            $this->BrojZapisa = mysqli_num_rows($this->Kolekcija);
        }
        else{
            $this->Kolekcija = mysql_query($Upit);
            $this->BrojZapisa = mysql_num_rows($this->Kolekcija);
        }
    }

    public function UcitajSvaPoljaFiltrirano($KriterijumFiltriranja, $KriterijumSortiranja)
    {
        $SQL = "select * from `".$this->NazivBazePodataka."`.`".$this->NazivTabele."` 
        WHERE".$KriterijumFiltriranja." ORDER BY ".$KriterijumSortiranja; 

        if($this->TipMYSQL=="mysqli")
        {
            $this->Kolekcija = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $SQL);
            $this->BrojZapisa = mysqli_num_rows($this->Kolekcija);
        }
        else
        {
            $this->Kolekcija = mysql_query($SQL);
            $this->BrojZapisa = mysql_num_rows($this->Kolekcija);
        }
    }

    public function UcitajPoljaFiltrirano($Polja, $KriterijumFiltriranja, $KriterijumSortiranja)
    {
        $SQL = "select ".$Polja."from `".$this->NazivBazePodataka."`.`".$this->NazivTabele."` WHERE
        ".$KriterijumFiltriranja." ORDER BY ".$KriterijumSortiranja;

        if($this->TipMYSQL=="mysqli"){
            $this->Kolekcija = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $SQL);
            $this->BrojZapisa = mysqli_num_rows($this->Kolekcija);
        }
        else{
            $this->Kolekcija = mysql_query($SQL);
            $this->BrojZapisa = mysql_num_rows($this->Kolekcija);
        }
    }

    public function DajVrednostJednogPoljaPrvogZapisa ($NazivTrazenogPolja, $KriterijumFiltriranja, $KriterijumSortiranja)
    {
        $SQL = "select ".$NazivTrazenogPolja." from `".$this->NazivBazePodataka."`.`".$this->NazivTabele."`
        WHERE ".$KriterijumFiltriranja." ORDER BY ".$KriterijumSortiranja;

        if($this->TipMYSQL=="mysqli")
        {
            $Kolekcija = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $SQL);
            $row = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $SQL);
            $Vrednost=$row [0];
        }
        else{
            $Kolekcija = mysql_query($SQL);
            $Vrednost = mysql_result($Kolekcija,0,$NazivTrazenogPolja);
        }
        return $Vrednost;
    }

    public function PrebaciKolekcijuUListu($Kolekcija)
    {
        $ListaZapisa = array();
        if($this->TipMYSQL=="mysqli")
        {
            while($RedZapisa = mysqli_fetch_array($Kolekcija, MYSQLI_NUM))
            {
                $this->ListaZapisa[] = $RedZapisa;
            }
        }
        else{
            while($RedZapisa = mysql_fetch_array($Kolekcija, MYSQLI_NUM))
            {
                $this->ListaZapisa[] = $RedZapisa; 
            }
        }
      return $ListaZapisa;
    }

    public function DajVrednostPoRednomBrojuZapisaPoRBPolja($Kolekcija, $RBZapisa, $RBPolja)
    {
        if($this->TipMYSQL=="mysqli")
        {
            $ListaZapisa = array();
            $ListaZapisa = $this->PrebaciKolekcijuUListu($Kolekcija);
            $RedZapisa = $this->ListaZapisa[$RBZapisa];
            $Vrednost = $RedZapisa [$RBPolja];
        }
        else{
            $Vrednost = mysql_result($Kolekcija, $RBZapisa, $RBPolja);
        }
      return $Vrednost;
    }

    public function PostojiZapis($KriterijumFiltriranja)
    {
        $SQL = "SELECT * FROM `".$this->NazivBazePodataka."`.`".$this->NazivTabele."` 
        WHERE".$KriterijumFiltriranja;

        if($this->TipMYSQL == "mysqli")
        {
            $KolekcijaLokalna = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $SQL);
            $BrojZapisaLokalna = mysqli_num_rows($KolekcijaLokalna);
        }
        else{
            $KolekcijaLokalna = mysql_query($SQL);
            $BrojZapisaLokalna = mysql_num_rows($KolekcijaLokalna);
        }
        if($BrojZapisaLokalna > 0){
            $postoji = true;
        }
        else{
            $postoji = false;
        }
      return $postoji;
   }
   
    public function IzvrsiAktivanSQLUpit($AktivanSQLUpit)
    {
        if($this->TipMYSQL == "mysqli")
        {
            $retval = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $AktivanSQLUpit);
            $Greska = mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        }
        else{
            $retval = mysql_query($AktivanSQLUpit, $this->OtvorenaKonekcija->konekcijaMYSQL);
            $Greska = mysql_error();
        }
        return $Greska;
    }
 }
?>