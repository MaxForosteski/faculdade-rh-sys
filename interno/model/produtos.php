<?php
/*Criar um registro na tabela de produtos. Output:Novo_Id,IsSuccess,Message*/
function CreateProduto($nome,$marca,$estoque,$DataCriacao){
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
}

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