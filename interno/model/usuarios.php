<?php
/*Criar um registro na tabela de usuario. Output:Novo_Id,IsSuccess,Message*/
function CreateUsuario($nome, $sobrenome, $senha, $isRH, $IsEstoque, $IsAdmin, $IsRoot, $DataCriacao) {
    include("../database/conexao-banco-de-dados.php");
    $new_senha = md5($senha);
    if(isset($nome, $sobrenome, $new_senha, $isRH, $IsEstoque, $IsAdmin, $IsRoot, $DataCriacao)) {
        $sql = "INSERT INTO usuarios (NOME, SOBRENOME, SENHA, ISRH, ISESTOQUE, ISADMIN, ISROOT, ATIVO, DATEDECRIACAO) VALUES (?, ?, ?, ?, ?, ?, ?, 1, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiiiis", $nome, $sobrenome, $new_senha, $isRH, $IsEstoque, $IsAdmin, $IsRoot, $DataCriacao);
        
        if($stmt->execute()) {
            $novo_id = $conn->insert_id;
            $response = array(
                "Novo_Id" => $novo_id,
                "IsSuccess" => true,
                "Message" => null 
            );
            $stmt->close();
            $conn->close();
            return (object)$response;
        } else {
            $response = array(
                "Novo_Id" => null,
                "IsSuccess" => false,
                "Message" => $stmt->error
            );
            $stmt->close();
            $conn->close();
            return (object)$response;
        }
    } else {
        $response = array(
            "Novo_Id" => null,
            "IsSuccess" => false,
            "Message" => "Missing parameters"
        );
        $conn->close();
        return (object)$response;
    }
}

#Editar um registro na tabela de usuario. Output:IsSuccess,Message
function UpdateUsuario($id, $nome, $sobrenome, $senha, $isRH, $IsEstoque, $IsAdmin, $IsRoot, $DataCriacao) {
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
}

#Editar um registro na tabela de usuario. Output:IsSuccess,Message
function InactiveUsuario($id) {
    include("../database/conexao-banco-de-dados.php");
    if(isset($id)) {
        $sql = "UPDATE usuarios SET ATIVO = 0 WHERE ID = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$id);
        
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