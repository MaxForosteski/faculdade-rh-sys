<?php

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$senha = $_POST['senha'];
$isRH = $_POST['isrh'];
$IsEstoque = $_POST['isestoque'];
$IsAdmin = $_POST['isadmin'];
$IsRoot = $_POST['isroot'];
$DataCriacao = $_POST['datacriacao'];

include("../database/conexao-banco-de-dados.php");
$new_senha = md5($senha);
if(isset($nome, $sobrenome, $new_senha, $isRH, $IsEstoque, $IsAdmin, $IsRoot, $DataCriacao)) {
    $sql = "INSERT INTO usuarios (NOME, SOBRENOME, SENHA, ISRH, ISESTOQUE, ISADMIN, ISROOT, ATIVO, DATEDECRIACAO) VALUES (?, ?, ?, ?, ?, ?, ?, 1, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiiis", $nome, $sobrenome, $new_senha, $isRH, $IsEstoque, $IsAdmin, $IsRoot, $DataCriacao);
    
    if($stmt->execute()) {
        $novo_id = $conn->insert_id;
        $response = array(
            "Novo_Id" => $novo_id,
            "IsSuccess" => true,
            "Message" => null 
        );
        $stmt->close();
        $conn->close();
        return (object)$response;
    } else {
        $response = array(
            "Novo_Id" => null,
            "IsSuccess" => false,
            "Message" => $stmt->error
        );
        $stmt->close();
        $conn->close();
        return (object)$response;
    }
} else {
    $response = array(
        "Novo_Id" => null,
        "IsSuccess" => false,
        "Message" => "Missing parameters"
    );
    $conn->close();
    return (object)$response;
}

?>