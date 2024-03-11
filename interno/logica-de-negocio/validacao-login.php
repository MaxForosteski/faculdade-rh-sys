<?php

function ValidacaoLogin($nome,$senha){
    include("conexao-banco-de-dados.php");

    $sql = "SELECT NOME,SENHA FROM usuarios WHERE NOME = '$nome' AND SENHA = '$senha'";

    $res = mysqli->query($sql);

}

?>