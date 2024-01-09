<?php

include 'Konekcija.php';


$sql="SELECT doprinosID, VrstaDrveta, PovršinaSume, Datum, Neto from prethodnesece";
$sql2="SELECT NazivDrveta, VrstaRada, Cena from TROSKOVI";

$result = $connection-> query($sql);
$num_result = 1;

// must pull at least 1 row
if($result-> num_rows > 0){
    while($row = $result->fetch_assoc()){
        $id = $row["doprinosID"];
        echo      
            "<tr class='zarada__row'>",
            "<form action='#' method='POST'>",
            "</tr><td>". $num_result++ .
            "</td><td>". $row["VrstaDrveta"]."</td>",
            "</td><td>". $row["PovršinaSume"]."</td>",
            "</td><td>". $row["Datum"]."</td>",
            "</td><td>". $row["Neto"]."</td>",
            "</td><td><button><img src='/SECA-SUMA/FrontEnd/Assets/edit-text.png' alt='edit.png'></button></td>",
            "</td><td><button name='delete'><img src='/SECA-SUMA/FrontEnd/Assets/trash-can.png' alt='edit.png'></button></td></form></tr>";
    }
}else{
    echo "Nema rezultata";
}

    if(isset($_POST['delete'])){
        echo "deleteBtnTriggered";
        $predhSeceID = $_POST['delete'];
        $sql2 = "DELETE FROM `SUME`.`TROSKOVI` WHERE NazivDrveta='$predhSeceID'";
        $sql = "DELETE FROM `SUME`.`PRETHODNESECE` WHERE doprinosID='$predhSeceID'";
        $result = $connection-> query($sql);
        $result2 = $connection-> query($sql);
        echo"$result, $result2";
      }
 $connection->close();
?>