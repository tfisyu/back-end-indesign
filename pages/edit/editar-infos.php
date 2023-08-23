<?php

session_start();
ob_start();

include_once "../session/conexao.php";

if(!isset($_SESSION["usuario"])){
    header("location: ../session/login.php"); 
}
    $id= $_SESSION["usuario"][0];
    $nome= $_SESSION['usuario'][1];
    $cpf = $_SESSION['usuario'][2];
    $nasc = $_SESSION['usuario'][3];
    $email= $_SESSION["usuario"][4];
    $telefone = $_SESSION['usuario'][5];
    $foto = $_SESSION['usuario'][12];

    $query = "SELECT * FROM users WHERE id= '$id'";
    $result = $conn->prepare($query);
    $result->execute();

    if(($result) and ($result->rowCount() != 0)){
        $row = $result->fetch(PDO::FETCH_ASSOC);
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/inDesign/styles/editar.css">
    <title>Meu perfil</title>
</head>
<body>
<header>
    <img src="/inDesign/img/Wireframe PI 1.png" width="20%">
    <a class="a_header" href="../index.html">Início</a>
    <a class="a_header" href="../profissionais/index.html">Profissionais</a>
    <a class="a_header" href="../sobre.html">Sobre</a>
    <a class="a_header active" href="./index.php">Perfil</a>
    <a class="a_header" href="#">Quiz</a>
    <div class="container">
        <form action="" class="search-bar">
            <input type="text" placeholder="Pesquise aqui" name="q">
            <button type="submit"><img src="/inDesign/img/lupa.png"></button>
        </form>
    </div>
</header>

<section class="edit-container">
    <article class="edit-box">
        <h1>Alterar informações pessoais</h1>

        <form action="" method="POST" enctype='multipart/form-data'>

    <?php
        if(isset($_POST['edit-infos'])){
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $nasc = $_POST['nascimento'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];

            if(!isset($err)){

                $arquivo = $_FILES['foto'];
                if((isset($arquivo['name'])) and (!empty($arquivo['name']))){
                $query_edit_usuario = "UPDATE users SET foto=:foto, updated_at = NOW() WHERE id=:id";
                $edit_usuario = $conn->prepare($query_edit_usuario);
                $edit_usuario->bindParam(':foto', $arquivo['name'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);

                if($edit_usuario->execute()){
                    $diretorio = "pfp/$id/";

                    if((!file_exists($diretorio)) and (!is_dir($diretorio))){
                        mkdir($diretorio, 0777);
                    }

                    $nome_arquivo = $arquivo['name'];
                    if(move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo)){
                        if(((!empty($foto)) or ($foto != null)) and ($foto != $arquivo['name'])){
                            $endereco_imagem = "/inDesign/pages/edit/pfp/$id/$foto";
                            if(file_exists($endereco_imagem)){
                                unlink($endereco_imagem);
                            }
                        }
                    }
                }
                }

            $query = "UPDATE users SET nome=:nome, cpf=:cpf, nascimento=:nascimento, email=:email, telefone=:telefone, updated_at = NOW() WHERE id=:id";
            $edit = $conn->prepare($query);
            $edit->bindParam(':nome', $nome, PDO::PARAM_STR);
            $edit->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $edit->bindParam(':nascimento', $nasc, PDO::PARAM_STR);
            $edit->bindParam(':email', $email, PDO::PARAM_STR);
            $edit->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $edit->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $edit->execute();

        if($result){
            header('location: modal.php');
        }else{
            $err[]='Something went wrong';
        }
    }
}

        if(isset($err)){ 
            foreach($err as $err){ 
              echo '<span class="alerts">'.$err.'</span>'; 
            }
        }
    ?>

        <form class="editar-infos" name="edit-address" method="POST" enctype="multipart/form-data">
            <center>
            <?php if($foto==NULL){
                 echo '<img src="/inDesign/img/default_pfp.png">';
                } else { 
                    echo "<img src='/inDesign/pages/edit/pfp/$id/$foto' style='width:100px; border-radius:80%;'>";
                }
            ?> 
                <div class="input">
                    <label>Change Image &#8595;</label>
                    <input class="form-control" type="file" name="foto" style="width:100%;" >
                </div>

            </center>
            <div class="input">
                <label>Nome</label><span class="obrigatorio">*</span><br>
                <input type="text" class="nome required" size="10px" name="nome" value="<?php echo $nome; ?>" required autofocus>
                <span class="span-required">CEP inválido</span>
            </div>
            <div class="input">
                <label>CPF</label><span class="obrigatorio">*</span><br>
                <input type="text" class="cpf required" size="10px" name="cpf" value="<?php echo $cpf; ?>">
            </div>
            <div class="input">
                <label>Data de nascimento</label><span class="obrigatorio">*</span><br>
                <input type="date" class="nascimento required" size="20px" name="nascimento" value="<?php echo $nasc; ?>">
            </div>
            <div class="input">
                <label>E-mail</label><span class="obrigatorio">*</span><br>
                <input type="text" class="email required" size="35px" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input">
                <label>Telefone</label><span class="obrigatorio">*</span><br>
                <input type="text" class="telefone required" size="10px" name="telefone" value="<?php echo $telefone; ?>">
                <span class="span-required">Insira um número de telefone"</span>
            </div>
            <span class="alerts"></span>
            <div class="edit-botoes" style="text-align: center;">
                <button type="button" id="cancel" onclick="location = '/inDesign/pages/meu perfil/index.php'">Cancelar</button>
                <button type="submit" id="save" name="edit-infos" class="submit-info">Salvar alterações</button>
            </div>
        </form>
    </article>
</section>
<footer>
    <section class="footer-container">
        <article class="side">
            <h2>Empresa</h2>
            <a href="#">Sobre a inDesign</a>
            <a href="#">Dúvidas Frequentes</a>
            <a href="#">Contato</a>
            <a href="#">Termos de Uso</a>
            <a href="#">Política de Privacidade</a>
        </article>

        <article class="side">
            <h2>Conheça</h2>
            <a href="#">Como funciona</a>
            <a href="#">Depoimentos</a>
            <a href="#">Teste de estilo</a>
            <a href="#">Preço</a>
        </article>

        <article class="side">
            <h2>Vem com a gente!</h2>
            <div class="icons">
                <a href="https://br.pinterest.com/" target="_blank"><img class="img_footer" src="/inDesign/img/pin.png"></a>
                <a href="https://www.instagram.com/" target="_blank"><img class="img_footer" src="/inDesign/img/instagram.png"></a>
                <a href="https://pt-br.facebook.com/" target="_blank"><img class="img_footer" src="/inDesign/img/face.png"></a>
            </div>
        </article>

        <article class="side">
            <h2>Precisa de ajuda?</h2>
            <div class="img-span">
                <img class="zap" src="/inDesign/img/logo_whats.png" width="18%">
                <span class="whats">(41)98736-9496</span>
            </div>
            <p class="horario">Disponível em horário comercial</p>
        </article>
    </section>
</footer>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
</body>
</html>