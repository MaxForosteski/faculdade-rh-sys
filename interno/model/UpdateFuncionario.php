<?php
#Editar um registro na tabela de funcionario. Output:IsSuccess,Message
$id = $_POST['id'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$datadenascimento = $_POST['datadenascimento'];
$cargo = $_POST['cargo'];
$setorid = $_POST['setorid'];
$cpf = $_POST['setorid'];
$salario = $_POST['salario'];
$DataCriacao = $_POST['datacriacao'];

include("../database/conexao-banco-de-dados.php");

if(isset($id,$nome, $sobrenome, $datadenascimento, $cargo, $setorid, $cpf, $salario, $DataCriacao)) {
    $sql = "UPDATE funcionarios SET NOME=?, SOBRENOME=?, DATADENASCIMENTO=?, CARGO=?, SETORID=?, CPF=?, SALARIO=?, ATIVO=1, DATEDECRIACAO=? WHERE ID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisdsi", $nome, $sobrenome, $datadenascimento, $cargo, $setorid, $cpf, $salario, $DataCriacao, $id);
    
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