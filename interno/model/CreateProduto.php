<?php
$nome = $_POST['nome'];
$marca = $_POST['marca'];
$estoque = $_POST['estoque'];
$DataCriacao = $_POST['datacriacao'];

    include("../database/conexao-banco-de-dados.php");
    if(isset($nome,$marca,$estoque,$DataCriacao)){
        $sql = "INSERT INTO produtos (NOME,MARCA,ESTOQUE,ATIVO,DATEDECRIACAO) VALUES (?,?,?,1,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis",$nome,$marca,$estoque,$DataCriacao);
        
        if($stmt->execute()){
            $novo_id = $stmt->insert_id;
            $response = array(
                "Novo_Id" => $novo_id,
                "IsSuccess" => true,
                "Message" => null 
            );
            $stmt->close();
            $conn->close();
            return (object)$response;
        }else{
            $response = array(
                "Novo_Id" => null,
                "IsSuccess" => false,
                "Message" => $stmt->error
            );
            $stmt->close();
            $conn->close();
            return (object)$response;
        }
    }else{
        $response = array(
            "Novo_Id" => null,
            "IsSuccess" => false,
            "Message" => "Missing parameters"
        );
        $conn->close();
        return (object)$response;
    }

?>