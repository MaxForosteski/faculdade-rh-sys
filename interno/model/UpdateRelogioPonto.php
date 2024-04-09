<?php 
#Editar um registro na tabela de relogio-ponto. Output:IsSuccess,Message
$id = $_POST['id'];
$horario = $_POST['horario'];
$data = $_POST['funcionarioID'];
$funcionarioID = $_POST['funcionarioID'];

include("../database/conexao-banco-de-dados.php");

if(isset($id, $horario,$data,$funcionarioID)) {
    $sql = "UPDATE relogioponto SET HORARIO=?, DATA=?, FUNCIONARIOID=?, ATIVO=1 WHERE ID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $horario,$data,$funcionarioID, $id);
    
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