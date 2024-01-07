<?php
class DBPredhSece extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $VrstaDrveta;
public $PovršinaSume;
public $Datum;
public $Neto;

    public function UcitajKolekcijaSvihSeca()
    {
        $SQL = "select * from `PRETHODNESECE` ORDER BY Datum ASC";
        $this->UcitajSvePoUpitu($SQL);    
    }

    public function InkrementirajBrojSeca($doprinosID)
    {
        $KriterijumFiltriranja = "VrstaDrveta ='".$doprinosID."'";
        $StaraVrednostUkBrSeca = $this-> DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojSeca',
        $KriterijumFiltriranja, 'UkupanBrojSeca');

        $NovaVrednostUkBrSeca = $StaraVrednostUkBrSeca + 1;

        $SQL = "UPDATE `".$this->NazivBazePodataka"`.`PRETHODNESECE` SET UkupanBrojSeca=".$NovaVrednostUkBrSeca"
        WHERE VrstaDrveta ='".$doprinosID"'";
          $greska= $this->IzvrsiAktivanUpit($SQL);

          return $greska;
    }
    
    public function DajKolekcijuSecaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
    {
        if($nacinFiltriranja == "like"){
            $SQL = "select * from * `PRETHODNESECE` WHERE $filterPolje like `%".$filterVrednost."%' ORDER BY $Sortiranje";
        }
        else{
            $SQL = "select * from `PRETHODNESECE` WHERE $filterPolje = '".$filterVrednost."' ORDER BY $Sortiranje";
        }
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    
    public function DodajNovuSecu(){
        $SQL = "INSERT INTO `PRETHODNESECE` (VrstaDrveta, PovršinaSume, Datum, Neto)
        VALUES ('$this->VrstaDrveta', '$this->PovršinaSume', '$this->Datum', '$this->Neto')";

        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function ObrisiSecu($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `PRETHODNESECE` WHERE ID=".$IdZaBrisanje;
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function IzmeniSecu($IdZaIzmenu, $NovaVrstaDrveta, $NovaPovrsinaSume, $NoviDatum, $NoviNeto)
    {
        $SQL = "UPDATE `PRETHODNESECE` SET VrstaDrveta='".$NovaVrstaDrveta."',
        PovršinaSume = ".$NovaPovrsinaSume.", Datum = '".$NoviDatum."', Neto= ".$NoviNeto." WHERE ID=".$IdZaIzmenu;

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

}
?>