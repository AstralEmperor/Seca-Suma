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
public $Mesto;
public $Trosak;

    public function UcitajKolekcijaSvihSeca()
    {
        $SQL = "select * from `ZAKAZANASECA` ORDER BY Datum ASC";
        $this->UcitajSvePoUpitu($SQL);    
    }

    public function InkrementirajBrojSeca($doprinosID)
    {
        $KriterijumFiltriranja = "VrstaDrveta ='".$doprinosID."'";
        $StaraVrednostUkBrSeca = $this-> DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojSeca', $KriterijumFiltriranja, 'UkupanBrojSeca');

        $NovaVrednostUkBrSeca = $StaraVrednostUkBrSeca + 1;

        $SQL = "UPDATE `".$this->NazivBazePodataka"`.`ZAKAZANASECA` SET UkupanBrojSeca=".$NovaVrednostUkBrSeca"
        WHERE VrstaDrveta ='".$doprinosID"'";
          $greska= $this->IzvrsiAktivanUpit($SQL);

          return $greska;
    }
    
    public function DajKolekcijuSecaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
    {
        if($nacinFiltriranja == "like"){
            $SQL = "select * from * `ZAKAZANASECA` WHERE $filterPolje like `%".$filterVrednost."%' ORDER BY $Sortiranje";
        }
        else{
            $SQL = "select * from `ZAKAZANASECA` WHERE $filterPolje = '".$filterVrednost."' ORDER BY $Sortiranje";
        }
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    
    public function DodajNovuSecu(){
        $SQL = "INSERT INTO `ZAKAZANASECA` (VrstaDrveta, PovršinaSume, Datum, Neto, Mesto, Trosak)
        VALUES ('$this->VrstaDrveta', '$this->PovršinaSume', '$this->Datum', '$this->Neto', '$this->Mesto', '$this->Trosak)";

        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function ObrisiSecu($IdZaBrisanje)
    {
        $SQL = "DELETE FROM `ZAKAZANASECA` WHERE ID=".$IdZaBrisanje;
        $greska = $this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

    public function IzmeniSecu($IdZaIzmenu, $NovaVrstaDrveta, $NovaPovrsinaSume, $NoviDatum, $NoviNeto, $NovoMesto, $NoviTrosak)
    {
        $SQL = "UPDATE `ZAKAZANASECA` SET VrstaDrveta='".$NovaVrstaDrveta."',
        PovršinaSume = ".$NovaPovrsinaSume.", Datum = '".$NoviDatum."', Neto= ".$NoviNeto.", Mesto='".$NovoMesto."',Trosak='".$NoviTrosak."' WHERE ID=".$IdZaIzmenu;

        $greska=$this->IzvrsiAktivanSQLUpit($SQL);

        return $greska;
    }

}
?>