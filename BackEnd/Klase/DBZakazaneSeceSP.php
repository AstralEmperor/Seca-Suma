<?php
    class DBZakazaneSece extends Tabela{
        private $bazapodataka;
        private $UspehKonekcijeNaDBMS;

        public $VrstaDrveta;
        public $PovrsinaSume;
        public $Datum;
        public $Neto;
        public $Mesto;
        public $Trosak;

        public function DodajNovuSecu(){
            $GreskarezultatPar1 = $this->IzvrsiAktivanSQLUpit("SET @VrstaDrvetaParametar='".$this->VrstaDrveta"'");
            $GreskarezultatPar2 = $this->IzvrsiAktivanSQLUpit("SET @PovrsinaSumeParametar='".$this->PovrsinaSume"'");
            $GreskarezultatPar3 = $this->IzvrsiAktivanSQLUpit("SET @DatumParametar='".$this->Datum"'");
            $GreskarezultatPar4 = $this->IzvrsiAktivanSQLUpit("SET @NetoParametar='".$this->Neto"'");
            $GreskarezultatPar5 = $this->IzvrsiAktivanSQLUpit("SET @MestoParametar='".$this->Mesto"'");
            $GreskarezultatPar6 = $this->IzvrsiAktivanSQLUpit("SET @TrosakParametar='".$this->Trosak"'");

            $greskarezultatCall = $this->IzvrsiAktivanSQLUpit("CALL `DodajSecu`(@VrstaDrvetaParametar,@PovrsinaSumeParametar,
            @DatumParametar,@NetoParametar,@MestoParametar,@TrosakParametar);");

            $greska = $GreskarezultatPar1.$GreskarezultatPar2.$GreskarezultatPar3.$GreskarezultatPar4.$GreskarezultatPar5.$GreskarezultatPar6.
            $greskarezultatCall;
            return $greska;
        }
    }
?>