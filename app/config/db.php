<?php 

$servername = "localhost";
$dbusername = "root";
$dbpassword = "Th3Pa55word1";
$database = "salud_mental";

$conn = new mysqli($servername, $dbusername, $dbpassword,$database);

if($conn->connect_error){
    die("error de base de datos ".$conn->connect_error);
}

