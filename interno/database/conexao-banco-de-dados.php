<?php

$host ="localhost";
$username = "root";
$password = "";
$database = "faculdade-rh-sys";

$conn = new mysqli($host,$username,$user,$password);

if($conn->connect_errno){
    die("Falha ao conectar com o Banco de dados: $conn->connect_error");
}


?>