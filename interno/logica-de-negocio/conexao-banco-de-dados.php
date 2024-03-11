<?php

$host ="localhost";
$username = "root";
$password = "";
$database = "faculdade-rh-sys";

$mysqli = new mysqli($host,$username,$user,$password);

if($mysqli->connect_errno){
    die("Falha ao conectar com o Banco de dados: $mysqli->connect_error");
}


?>