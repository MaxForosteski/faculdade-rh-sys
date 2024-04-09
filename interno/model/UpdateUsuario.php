<?php

#Editar um registro na tabela de usuario. Output:IsSuccess,Message

$id = $_POST['id'];
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
if(isset($id, $nome, $sobrenome, $new_senha, $isRH, $IsEstoque, $IsAdmin, $IsRoot, $DataCriacao)) {
    $sql = "UPDATE usuarios SET NOME=?, SOBRENOME=?, SENHA=?, ISRH=?, ISESTOQUE=?, ISADMIN=?, ISROOT=?, ATIVO=1, DATEDECRIACAO=? WHERE ID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiiisi", $nome, $sobrenome, $new_senha, $isRH, $IsEstoque, $IsAdmin, $IsRoot, $DataCriacao, $id);
    
    if($stmt->execute()) {
        $response = array(
            "IsSuccess" => true,
            "Message" => null
        );
        $stmt->close();
        $conn->close();
        return (object)$response;
    } else {
        $response = array(
            "IsSuccess" => false,
            "Message" => $stmt->error
        );
        $stmt->close();
        $conn->close();
        return (object)$response;
    }
} else {
    $response = array(
        "IsSuccess" => false,
        "Message" => "Missing parameters"
    );
    $conn->close();
    return (object)$response;
}

?>