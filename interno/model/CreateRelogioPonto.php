<?php
/*Criar um registro na tabela de relogioponto. Output:Novo_Id,IsSuccess,Message*/

$horario = $_POST['horario'];
$data = $_POST['data'];
$funcionarioID = $_POST['funcionarioID'];

include("../database/conexao-banco-de-dados.php");
if(isset($horario,$data,$funcionarioID)){
    $sql = "INSERT INTO relogioponto (HORARIO,DATA,FUNCIONARIOID,ATIVO) VALUES (?,?,?,1,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi",$horario,$data,$funcionarioID);
    
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