<?php



function ValidacaoLogin($Rlogin,$Rsenha){
    session_start();

    include("../database/conexao-banco-de-dados.php");

    $login = isset($Rlogin) ? addslashes(trim($Rlogin)) : false;
    $senha = isset($Rsenha) ? md5(trim($Rsenha)) : false;

    if(!$login || !$senha){
        $status_transaction = array(
            "isSuccess" => false,
            "message" => "Digite seu nome e senha!"
        );
        
        return (object)$status_transaction;
    }

        $sql = "SELECT * FROM usuarios WHERE nome = $login ";
        $result_id = $mysql->query($sql);

}

?>