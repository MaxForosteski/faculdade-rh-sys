<?php
/*Criar um registro na tabela de usuario. Output:Novo_Id,IsSuccess,Message*/
function CreateUsuario($nome,$sobrenome,$senha,$isRH,$IsEstoque,$IsAdmin,$IsRoot,$DataCriacao){
    include("../database/conexao-banco-de-dados.php");

    if(isset($nome,$sobrenome,$senha,$isRH,$IsEstoque,$IsAdmin,$IsRoot,$DataCriacao)){
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
                "Message" => "Um erro inesperado ocorreu ao tentar finalizar a transação"
            );

            return (object)$response;
        }
        
    }else{
        $response = array(
            "Novo_id" => null,
            "IsSuccess" => false,
            "Message" => "Todos os campos devem ser preenchidos"
        );
        return (object)$response;
    }
}

?>