<?php
//  Upravlja svim funkcijama koje rade sa podatcima iz DB ZAKAZANASECA, nasledjuje klasu TABELA
    class DBZakazaneSece extends Tabela{
         // Poziva pogled `SVEZAKAZANESECE`, gde je filter parametar VrstaDrveta
        public function DajSvePodatkeOZakazanimSecama($filterParametar){
            if(isset($filterParametar)){
                $upit="select * from `".$this->NazivBazePodataka."`.`SVEZAKAZANESECE` where `VrstaDrveta`='".$filterParametar."'";
            }else{
                $upit="select * from `".$this->NazivBazePodataka."`.`SVEZAKAZANESECE`";
            }
            $this->UcitajSvePoUpitu($upit);
        }
        // Poziva pogled `DajSvePodatkeOZakazanimPlacenimUnapred`, gde je filter parametar VrstaDrveta
        public function DajSvePodatkeOZakazanimSecamaPlacenimUnapred($filterParametar){
            if(isset($filterParametar)){
                $upit="select * from `".$this->NazivBazePodataka."`.`SVESECEPLACENEUNAPRED` where `VrstaDrveta`='".$filterParametar."'";
            }else{
                $upit="select * from `".$this->NazivBazePodataka."`.`SVESECEPLACENEUNAPRED`";
            }
            $this->UcitajSvePoUpitu($upit);
        }
    }
?>