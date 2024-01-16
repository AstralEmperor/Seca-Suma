<?php
    class DBZakazaneSece extends Tabela{
        public function DajSvePodatkeOZakazanimSecama($filterParametar){
            if(isset($filterParametar)){
                $upit="select * from `".$this->NazivBazePodataka."`.`SVEZAKAZANESECE` where `VrstaDrveta`='".$filterParametar."'";
            }else{
                $upit="select * from `".$this->NazivBazePodataka."`.`SVEZAKAZANESECE`";
            }
            $this->UcitajSvePoUpitu($upit);
        }
    }
?>