<?php
    class DBZakazaneSece extends Tabela{
        public function DajSvePodatkeOZakazanimSecema($filterParametar){
            if(isset($filterParametar)){
                $upit="select * from `".$this->NazivBazePodataka."`.`SVESECEUNUTARMESTA` where `DoprinosID`='".$filterParametar."'";
            }else{
                $upit="select * from `".$this->NazivBazePodataka."`.`SVESECEUNUTARMESTA`";
            }
            $this->UcitajSvePoUpitu($upit);
        }
    }
?>