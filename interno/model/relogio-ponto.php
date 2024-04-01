<?php
/*Criar um registro na tabela de relogioponto. Output:Novo_Id,IsSuccess,Message*/
function CreateRelogioPonto($horario,$data,$funcionarioID){
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
}

#Editar um registro na tabela de relogio-ponto. Output:IsSuccess,Message
function UpdateRelogioPonto($id,$horario,$data,$funcionarioID) {
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
}


#Editar um registro na tabela de relogioponto. Output:IsSuccess,Message
function InactiveRelogioPonto($id) {
    include("../database/conexao-banco-de-dados.php");
    
    if(isset($id)) {
        $sql = "UPDATE relogioponto SET ATIVO = 0 WHERE ID = ?";
        
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