<?php

require 'Konekcija.php';
    
// INSERTS NEW DATA 


    if(isset($_POST['submit'])){
        $VrstaDrveta = $_POST['vrstadrveta'];
        $PovršinaSume = $_POST['povrsina'];
        $Datum = $_POST['datum'];
        $Neto = $_POST['zarada'];
 
        $Troskovi = $_POST['troskovi'];
        $VrstaRada = $_POST['vrstaRada'];
 
     $SQL="INSERT into `SUME`.`TROSKOVI`(NazivDrveta,VrstaRada,Cena) values ('$VrstaDrveta', '$VrstaRada', $Troskovi)";
     $SQL2="INSERT into `SUME`.`PRETHODNESECE`(VrstaDrveta,PovršinaSume,Datum,Neto) values ('$VrstaDrveta', $PovršinaSume, '$Datum', $Neto)";

     $result = $connection-> query($SQL);
     $result = $connection-> query($SQL2);
     echo "$result";
  }
 
?>