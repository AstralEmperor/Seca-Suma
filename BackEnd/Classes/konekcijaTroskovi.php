<?php

require 'Konekcija.php';

$sql="SELECT NazivDrveta, VrstaRada, Cena from TROSKOVI";
$result = $connection-> query($sql);
$num_result = 1;
// must pull at least 1 row
if($result-> num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo             
            "<tr class='troskovi__row'><td>". $num_result++. 
            "</td><td>". $row["NazivDrveta"].
            "</td><td>". $row["VrstaRada"]."</td>".
            "</td><td>". $row["Cena"]."</td>",
            "</td><td><img src='/SECA-SUMA/FrontEnd/Assets/edit-text.png' alt='edit.png'></td>",
            "</td><td><img src='/SECA-SUMA/FrontEnd/Assets/trash-can.png' alt='edit.png'></td></tr>";
    }
}else{
    echo "Nema rezultata";
}
$connection-> close();
?>