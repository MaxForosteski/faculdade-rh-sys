<?php


#Editar um registro na tabela de produtos. Output:IsSuccess,Message
function UpdateProduto($id,$nome,$marca,$estoque,$DataCriacao) {
    include("../database/conexao-banco-de-dados.php");
    
    if(isset($id, $nome,$marca,$estoque,$DataCriacao)) {
        $sql = "UPDATE produtos SET NOME=?, MARCA=?, ESTOQUE=?, ATIVO=1, DATEDECRIACAO=? WHERE ID = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisi", $nome,$marca,$estoque, $DataCriacao, $id);
        
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