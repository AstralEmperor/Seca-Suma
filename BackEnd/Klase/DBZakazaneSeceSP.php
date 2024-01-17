<?php
    class DBZakazaneSece extends Tabela{
        private $bazapodataka;
        private $UspehKonekcijeNaDBMS;

        public $VrstaDrveta;
        public $PovrsinaSume;
        public $Datum;
        public $Neto;
        public $Trosak;
        public $Mesto;
        public $PlacenoUnapred;

        // dodaj novu secu uz koriscenje procedure za proveru postojanja podataka (ZakaziSecu), vraca gresku za svaki neispravan parametar
        public function DodajNovuSecu(){
            $GreskarezultatParam1 = $this->IzvrsiAktivanSQLUpit("SET @VrstaDrvetaParametar='".$this->VrstaDrveta."'");
            $GreskarezultatParam2 = $this->IzvrsiAktivanSQLUpit("SET @PovrsinaSumeParametar=".$this->PovrsinaSume."");
            $GreskarezultatParam3 = $this->IzvrsiAktivanSQLUpit("SET @DatumParametar='".$this->Datum."'");
            $GreskarezultatParam4 = $this->IzvrsiAktivanSQLUpit("SET @NetoParametar=".$this->Neto."");
            $GreskarezultatParam5 = $this->IzvrsiAktivanSQLUpit("SET @TrosakParametar=".$this->Trosak."");
            $GreskarezultatParam6 = $this->IzvrsiAktivanSQLUpit("SET @MestoParametar='".$this->Mesto."'");
            $GreskarezultatParam7 = $this->IzvrsiAktivanSQLUpit("SET @PlacenoUnapredParametar=".$this->PlacenoUnapred."");
            $greskarezultatCall = $this->IzvrsiAktivanSQLUpit("CALL `ZakaziSecu`(@VrstaDrvetaParametar, @PovrsinaSumeParametar,
            @DatumParametar, @NetoParametar,@TrosakParametar, @MestoParametar, @PlacenoUnapredParametar);");

            $greska = $GreskarezultatParam1.$GreskarezultatParam2.$GreskarezultatParam3.$GreskarezultatParam4.$GreskarezultatParam5.$GreskarezultatParam6.$GreskarezultatParam7.
            $greskarezultatCall;
            return $greska;
        }
    }
?>