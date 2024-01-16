<?php

class DBTroskovi extends Tabela
{
    // ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $Mesto;
public $UkupanBrojSeca;

    public function UcitajKolekcijuSvihMesta()
    {
        $SQL = "select * from `TROSKOVI` ORDER BY Mesto ASC";
        $this->UcitajSvePoUpitu($SQL);    
    }

    public function InkrementirajBrojMesta($UkupanBrojSeca)
    {
        $KriterijumFiltriranja = "UkupanBrojSeca ='".$UkupanBrojSeca."'";
        $StaraVrednostUkBrMesta = $this-> DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojSeca', $KriterijumFiltriranja, 'UkupanBrojSeca');

        $NovaVrednostUkBrMesta = $StaraVrednostUkBrMesta + 1;

        $SQL = "UPDATE `.$this->NazivBazePodataka`.`TROSKOVI` SET UkupanBrojSeca='".$NovaVrednostUkBrMesta."'
        WHERE UkupanBrojSeca ='.$UkupanBrojSeca.'";
          $greska= $this->IzvrsiAktivanUpit($SQL);

          return $greska;
    }
    
    public function DajKolekcijuMestaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
    {
        if($nacinFiltriranja == "like"){
            $SQL = "select * from * `TROSKOVI` WHERE $filterPolje like `%".$filterVrednost."%' ORDER BY $Sortiranje";
        }
        else{
            $SQL = "select * from `TROSKOVI` WHERE $filterPolje = '".$filterVrednost."' ORDER BY $Sortiranje";
        }
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    public function DajUkupanBrojSvihMesta($KolekcijaZapisa)
        {
        return $this->BrojZapisa;
        }
    
    public function DodajNovoMesto(){
        $SQL = "INSERT INTO `TROSKOVI` (Mesto, UkupanBrojSeca)
        VALUES ('$this->Mesto', '$this->UkupanBrojSeca')";

        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function ObrisiMesto($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `TROSKOVI` WHERE Mesto=".$IdZaBrisanje;
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function IzmeniMesto($NovoMesto, $NoviUkupanBrojSeca)
    {
        $SQL = "UPDATE `TROSKOVI` SET Mesto='".$NovoMesto."',
        UkupanBrojSeca = ".$NoviUkupanBrojSeca." WHERE Mesto=".$IdZaIzmenu;

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

}
?>