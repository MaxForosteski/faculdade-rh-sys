<?php
#Editar um registro na tabela de produtos. Output:IsSuccess,Message
function InactiveProduto($id) {
    include("../database/conexao-banco-de-dados.php");
    
    if(isset($id)) {
        $sql = "UPDATE produtos SET ATIVO = 0 WHERE ID = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
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
}
?>