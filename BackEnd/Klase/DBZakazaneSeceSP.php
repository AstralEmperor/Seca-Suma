<?php
//  Upravlja svim funkcijama koje rade sa podatcima iz DB ZAKAZANASECA, nasledjuje klasu TABELA
    class DBZakazaneSece extends Tabela{
        private $bazapodataka;
        private $UspehKonekcijeNaDBMS;

        public $VrstaDrveta;
        public $PovrsinaSumeID;
        public $Datum;
        public $Neto;
        public $TrosakPriRaduID;
        public $Mesto;
        public $PlacenoUnapred;

        // dodaj novu secu uz koriscenje PROCEDURE za proveru postojanja podataka (ZakaziSecu), vraca gresku za svaki neispravan parametar
        public function DodajNovuSecu(){
            $GreskarezultatParam1 = $this->IzvrsiAktivanSQLUpit("SET @VrstaDrvetaParametar='".$this->VrstaDrveta."'");
            $GreskarezultatParam2 = $this->IzvrsiAktivanSQLUpit("SET @PovrsinaSumeIDParametar=".$this->PovrsinaSumeID."");
            $GreskarezultatParam3 = $this->IzvrsiAktivanSQLUpit("SET @DatumParametar='".$this->Datum."'");
            $GreskarezultatParam4 = $this->IzvrsiAktivanSQLUpit("SET @NetoParametar=".$this->Neto."");
            $GreskarezultatParam5 = $this->IzvrsiAktivanSQLUpit("SET @TrosakPriRaduIDParametar=".$this->TrosakPriRaduID."");
            $GreskarezultatParam6 = $this->IzvrsiAktivanSQLUpit("SET @MestoParametar='".$this->Mesto."'");
            $GreskarezultatParam7 = $this->IzvrsiAktivanSQLUpit("SET @PlacenoUnapredParametar=".$this->PlacenoUnapred."");
            $greskarezultatCall = $this->IzvrsiAktivanSQLUpit("CALL `ZakaziSecu`(@VrstaDrvetaParametar, @PovrsinaSumeIDParametar,
            @DatumParametar, @NetoParametar,@TrosakPriRaduIDParametar, @MestoParametar, @PlacenoUnapredParametar);");

            $greska = $GreskarezultatParam1.$GreskarezultatParam2.$GreskarezultatParam3.$GreskarezultatParam4.$GreskarezultatParam5.$GreskarezultatParam6.$GreskarezultatParam7.
            $greskarezultatCall;
            return $greska;
        }
    }
?>