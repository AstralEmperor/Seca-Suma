<?php
//  Upravlja svim funkcijama koje rade sa podatcima iz DB MESTO, nasledjuje klasu TABELA
class DBMesto extends Tabela
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;

public $Mesto;
public $UkupanBrojSeca;

// Ucitava kolekciju svih mesta u odnosu na mesto
    public function UcitajKolekcijuSvihMesta()
    {
        $SQL = "select * from `MESTO` ORDER BY Mesto ASC";
        $this->UcitajSvePoUpitu($SQL);    
    }
// Inkrementira broj Ukupnog Broja Seca po mestu i inkrementuj ukupan broj mesta
    public function InkrementirajUkupanBrojSecaPoMestu($IDMesto)
    {
        $KriterijumFiltriranja = "Mesto='".$IDMesto."'";
        $StaraVrednostUkBrMesta = $this->DajVrednostJednogPoljaPrvogZapisa('UkupanBrojSeca', $KriterijumFiltriranja , 'UkupanBrojSeca');

        $NovaVrednostUkBrMesta = $StaraVrednostUkBrMesta + 1;

        $SQL = "UPDATE `".$this->NazivBazePodataka."`.`MESTO` SET UkupanBrojSeca='".$NovaVrednostUkBrMesta."' WHERE Mesto='".$IDMesto."'";
        $greska= $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
    // Dekrementuje broj Ukupnog Broja Seca po mestu prilikom prizanja zapisa i dekrementuj ukupan broj zapisa
    public function DekrementirajUkupanBrojSecaPoMestu($IDMesto)
    {
      $KriterijumFiltriranja = "Mesto='".$IDMesto."'";
        $StaraVrednostUkBrMesta = $this->DajVrednostJednogPoljaPrvogZapisa('UkupanBrojSeca', $KriterijumFiltriranja , 'UkupanBrojSeca');

        $NovaVrednostUkBrMesta = $StaraVrednostUkBrMesta - 1;

        $SQL = "UPDATE `".$this->NazivBazePodataka."`.`MESTO` SET UkupanBrojSeca='".$NovaVrednostUkBrMesta."' WHERE Mesto='".$IDMesto."'";
        $greska= $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
    // Vraca filtriranu kolekciju mesta
    public function DajKolekcijuMestaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
    {
        if($nacinFiltriranja == "like"){
            $SQL = "select * from * `MESTO` WHERE $filterPolje like `%".$filterVrednost."%' ORDER BY $Sortiranje";
        }
        else{
            $SQL = "select * from `MESTO` WHERE $filterPolje = '".$filterVrednost."' ORDER BY $Sortiranje";
        }
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
// Vraca ukupan broj svih mesta
    public function DajUkupanBrojSvihMesta($KolekcijaZapisa)
        {
        return $this->BrojZapisa;
        }
    // dodaje novo mesto
    public function DodajNovoMesto(){
        $SQL = "INSERT INTO `MESTO` (Mesto, UkupanBrojSeca)
        VALUES ('$this->Mesto', '$this->UkupanBrojSeca')";

        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }
// Brise mesto
    public function ObrisiMesto($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `MESTO` WHERE Mesto=".$IdZaBrisanje;
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function IzmeniMesto($NovoMesto, $NoviUkupanBrojSeca)
    {
        $SQL = "UPDATE `MESTO` SET Mesto='".$NovoMesto."', WHERE Mesto='".$IdZaIzmenu."'";

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

}
?>