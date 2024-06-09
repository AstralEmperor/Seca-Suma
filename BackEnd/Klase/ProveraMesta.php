<?php
    // Klasa zakazanopomestima poslovne logike, proverava da li podatci zadovoljavaju kriterijum pri unosu
    class zakazanopomestima extends Tabela{

    private $bazapodataka;
    private $UspehKonekcijeNaDBMS;
        
    // funkcija poslovne logike, proverava da li trenutno postoji ovlascenje za dozvoljenu seču unutar nekog mesta
        public function DaLiImaSlobodnihRezervacijaSeca($MestoSeceParametar){
            $odgovor="NE";
        
        // Izdvajanje ograničenja iz XML
        $xml=simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/".$MestoSeceParametar.".xml") or die("Učitavanje fajla sa ograničenjem, nije uspešno");
        $maxBrojSeca=$xml->MaxBrojSeca;

        // Preuzimanje trenutnnog broja seca po mestu
        $NazivTrazenogPolja = "count(`SecaID`)";
        $KriterijumFiltriranja = "`Mesto`='".$MestoSeceParametar."'";
        $KriterijumSortiranja="`SecaID`";
        $trenutanBrojSeca = $this->DajVrednostJednogPoljaPrvogZapisa($NazivTrazenogPolja, $KriterijumFiltriranja, $KriterijumSortiranja);

        if($trenutanBrojSeca < $maxBrojSeca){
            $odgovor = "DA";
        }else{
            $odgovor = "NE";
        }
        return $odgovor;
    }
}
?>