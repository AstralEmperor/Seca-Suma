<?php

$connection = mysqli_connect("localhost","root","","sume");
if($connection->connect_error){
    die("Connection failed". $connection_error);
}

$sql="SELECT NazivDrveta, VrstaRada, Cena from TROSKOVI";
$result = $connection-> query($sql);
$id = 1;

// must pull at least 1 row
if($result-> num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo             
            "<tr class='troskovi__row'><td>". $id++. 
            "</td><td>". $row["NazivDrveta"].
            "</td><td>". $row["VrstaRada"]."</td>".
            "</td><td>". $row["Cena"]."</td>",
            "</td><td><img src='/php-apps/Seča-Šuma/FrontEnd/Assets/edit-text.png' alt='edit.png'></td>",
            "</td><td><img src='/php-apps/Seča-Šuma/FrontEnd/Assets/trash-can.png' alt='edit.png'></td></tr>";
    }
}else{
    echo "Nema rezultata";
}
$connection-> close();
?>