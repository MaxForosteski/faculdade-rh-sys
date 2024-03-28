<?php
/*Criar um registro na tabela de usuario. Output:Novo_Id,IsSuccess,Message*/
function CreateFuncionario($nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao){
    include("../database/conexao-banco-de-dados.php");
    if(isset($nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao)){
        $sql = "INSERT INTO funcionarios (NOME,SOBRENOME,DATADENASCIMENTO,CARGO,SETORID,CPF,SALARIO,ATIVO,DATEDECRIACAO) VALUES (?,?,?,?,?,?,?,1,?)";

        $stmt = $conn->prepare($sql);
        $stmt = $conn->bind_params("ssssiids",$nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao);
        
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
function UpdateFuncionario($id,$nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao){
    include("../database/conexao-banco-de-dados.php");
    if(isset($nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao)){
        $sql = "UPDATE funcionarios SET NOME=? , SOBRENOME =?, DATADENASCIMENTO=?, CARGO=?, SETORID=?, CPF=?, SALARIO=?, ATIVO=1 DATEDECRIACAO=? WHERE ID = ?";

        $stmt = $conn->prepare($sql);
        $stmt = $conn->bind_params("ssssiidsi",$nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao,$id);
        
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

#Editar um registro na tabela de usuario. Output:IsSuccess,Message
function InactiveFuncionario($id,$ativo){
    include("../database/conexao-banco-de-dados.php");
    if(isset($id,$ativo)){
        $sql = "UPDATE usuarios SET ATIVO= ? WHERE ID = ?";

        $stmt = $conn->prepare($sql);
        $stmt = $conn->bind_params("ii",$ativo,$id);
        
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