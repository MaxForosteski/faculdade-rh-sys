<?php
/*Criar um registro na tabela de usuario. Output:Novo_Id,IsSuccess,Message*/
function CreateUsuario($nome,$sobrenome,$senha,$isRH,$IsEstoque,$IsAdmin,$IsRoot,$DataCriacao){
    include("../database/conexao-banco-de-dados.php");
    $new_senha = md5($senha);
    if(isset($nome,$sobrenome,$new_senha,$isRH,$IsEstoque,$IsAdmin,$IsRoot,$DataCriacao)){
        $sql = "INSERT INTO usuarios (NOME,SOBRENOME,SENHA,ISRH,ISESTOQUE,ISADMIN,ISROOT,DATEDECRIACAO) VALUES (?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt = $conn->bind_params("sssiiiis",$nome,$sobrenome,$senha,$isRH,$IsEstoque,$IsAdmin,$IsRoot,$DataCriacao);
        
        if($stmt->execute()){
            $novo_id = $conn->insert_id;
            $response = array(
                "Novo_Id" => $novo_id,
                "IsSuccess" => true,
                "Message" => null 
            );
            return (object)$response;
        }else{
            $response = array(
                "Novo_Id" => null,
                "IsSuccess" => false,
                "Message" => "$conn->error"
            );

            return (object)$response;
        }

    }else{
        $response = array(
            "Novo_id" => null,
            "IsSuccess" => false,
            "Message" => "$conn->error"
        );
        return (object)$response;
    }
    $stmt->close();
    $conn->close();
}
#Editar um registro na tabela de usuario. Output:IsSuccess,Message
function UpdateUsuario($id,$nome,$sobrenome,$senha,$isRH,$IsEstoque,$IsAdmin,$IsRoot,$DataCriacao){
    include("../database/conexao-banco-de-dados.php");
    $new_senha = md5($senha);
    if(isset($id,$nome,$sobrenome,$new_senha,$isRH,$IsEstoque,$IsAdmin,$IsRoot,$DataCriacao)){
        $sql = "UPDATE usuarios SET NOME=? , SOBRENOME =?, SENHA=?, ISRH=?, ISESTOQUE=?, ISADMIN=?, ISROOT=?, DATEDECRIACAO=? WHERE ID = ?";

        $stmt = $conn->prepare($sql);
        $stmt = $conn->bind_params("sssiiiisi",$nome,$sobrenome,$senha,$isRH,$IsEstoque,$IsAdmin,$IsRoot,$DataCriacao,$id);
        
        if($stmt->execute()){
            $response = array(
                "IsSuccess" => true,
                "Message" => null 
            );
            return (object)$response;
        }else{
            $response = array(
                "IsSuccess" => false,
                "Message" => "$conn->error"
            );

            return (object)$response;
        }

    }else{
        $response = array(
            "IsSuccess" => false,
            "Message" => "$conn->error"
        );
        return (object)$response;
    }
    $stmt->close();
    $conn->close();
}

?>