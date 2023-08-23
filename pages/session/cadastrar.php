<?php
require_once './conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_usuario_pes = "SELECT id FROM users WHERE email=:email LIMIT 1";
$result_usuario = $conn->prepare($query_usuario_pes);
$result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
$result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $retorna = ['erro' => true, 'msg' => "<span style='margin: 3rem 2rem; color: #f00; background-color: #F4998D; padding: .5rem 1rem; border-radius: 5px'>e-mail já cadastrado</span>"];
    }else{
        $query_usuario = "INSERT INTO users (nome, cpf, nascimento, email, telefone, senha) VALUES (:nome, :cpf, :nascimento, :email, :telefone, :senha)";

        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario->bindParam(':nome', $dados['nome']);
        $cad_usuario->bindParam(':cpf', $dados['cpf']);
        $cad_usuario->bindParam(':nascimento', $dados['nascimento']);
        $cad_usuario->bindParam(':email', $dados['email']);
        $cad_usuario->bindParam(':telefone', $dados['telefone']);
        $cad_usuario->bindParam(':senha', $dados['senha']);

        $cad_usuario->execute();
        
        if($cad_usuario->rowCount()){
            $retorna = ['erro' => false, 'msg' => "<span>usuário cadastrado com sucesso</span>"];
        }else{
            $retorna = ['erro' => true, 'msg' => "<span class='alerta-user'>usuário não cadastrado com sucesso</span>"];
        }
    }
    
    echo json_encode($retorna);
?>