<?php
/*Criar um registro na tabela de funcionario. Output:Novo_Id,IsSuccess,Message*/
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$datadenascimento = $_POST['datadenascimento'];
$cargo = $_POST['cargo'];
$setorid = $_POST['setorid'];
$cpf = $_POST['setorid'];
$salario = $_POST['salario'];
$DataCriacao = $_POST['datacriacao'];

include("../database/conexao-banco-de-dados.php");
if(isset($nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao)){
    $sql = "INSERT INTO funcionarios (NOME,SOBRENOME,DATADENASCIMENTO,CARGO,SETORID,CPF,SALARIO,ATIVO,DATEDECRIACAO) VALUES (?,?,?,?,?,?,?,1,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisds",$nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao);
        
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


