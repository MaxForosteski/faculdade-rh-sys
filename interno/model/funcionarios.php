<?php
/*Criar um registro na tabela de funcionario. Output:Novo_Id,IsSuccess,Message*/
function CreateFuncionario($nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao){
    include("../database/conexao-banco-de-dados.php");
    if(isset($nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao)){
        $sql = "INSERT INTO funcionarios (NOME,SOBRENOME,DATADENASCIMENTO,CARGO,SETORID,CPF,SALARIO,ATIVO,DATEDECRIACAO) VALUES (?,?,?,?,?,?,?,1,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisds",$nome,$sobrenome,$datadenascimento,$cargo,$setorid,$cpf,$salario,$DataCriacao);
        
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

#Editar um registro na tabela de funcionario. Output:IsSuccess,Message
function UpdateFuncionario($id, $nome, $sobrenome, $datadenascimento, $cargo, $setorid, $cpf, $salario, $DataCriacao) {
    include("../database/conexao-banco-de-dados.php");
    
    if(isset($id,$nome, $sobrenome, $datadenascimento, $cargo, $setorid, $cpf, $salario, $DataCriacao)) {
        $sql = "UPDATE funcionarios SET NOME=?, SOBRENOME=?, DATADENASCIMENTO=?, CARGO=?, SETORID=?, CPF=?, SALARIO=?, ATIVO=1, DATEDECRIACAO=? WHERE ID = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisdsi", $nome, $sobrenome, $datadenascimento, $cargo, $setorid, $cpf, $salario, $DataCriacao, $id);
        
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


#Editar um registro na tabela de funcionario. Output:IsSuccess,Message
function InactiveFuncionario($id) {
    include("../database/conexao-banco-de-dados.php");
    
    if(isset($id)) {
        $sql = "UPDATE funcionarios SET ATIVO = 0 WHERE ID = ?";
        
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