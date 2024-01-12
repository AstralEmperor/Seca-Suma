<?php
    class DBZakazaneSece extends Tabela{
        public function DajSvePodatkeOZakazanimSecema($filterParametar){
            if(isset($filterParametar)){
                $upit="select * from `".$this->NazivBazePodataka."`.`SVESECEUNUTARMESTA` where `VrstaDrveta`='".$filterParametar."'";
            }else{
                $upit="select * from `".$this->NazivBazePodataka."`.`SVESECEUNUTARMESTA`";
            }
            $this->UcitajSvePoUpitu($upit);
        }
    }
?>