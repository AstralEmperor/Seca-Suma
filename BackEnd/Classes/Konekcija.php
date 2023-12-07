<?php 

$connection = mysqli_connect("localhost","root","","sume");
if($connection->connect_error){
    die("ERROR! Connection failed". $connection_error);
}
?>