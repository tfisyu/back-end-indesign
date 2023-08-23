<?php

session_start();
ob_start();

include_once "../session/conexao.php";

if(!isset($_SESSION["usuario"])){
    header("location: ../session/login.php"); 
}
    $id= $_SESSION["usuario"][0];
    $rua= $_SESSION['usuario'][6];
    $numero = $_SESSION['usuario'][7];
    $cep = $_SESSION['usuario'][8];
    $estado= $_SESSION["usuario"][9];
    $cidade = $_SESSION['usuario'][10];
    $complemento = $_SESSION['usuario'][11];

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
    <a class="a_header active" href="./cobranca.php">Perfil</a>
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
        <h1>Alterar endereço</h1>

    <?php
        if(isset($_POST['save'])){
            $cep = $_POST['cep'];
            $estado = $_POST['estado'];
            $rua = $_POST['rua'];
            $numero = $_POST['numero'];
            $cidade = $_POST['cidade'];
            $complemento = $_POST['complemento'];
                if(!isset($err)){
                    $query = "UPDATE users SET cep=:cep, rua=:rua, estado=:estado, numero=:numero, cidade=:cidade, complemento=:complemento WHERE id=:id";
                    $edit = $conn->prepare($query);
                    $edit->bindParam(':cep', $cep, PDO::PARAM_STR);
                    $edit->bindParam(':estado', $estado, PDO::PARAM_STR);
                    $edit->bindParam(':rua', $rua, PDO::PARAM_STR);
                    $edit->bindParam(':numero', $numero, PDO::PARAM_STR);
                    $edit->bindParam(':cidade', $cidade, PDO::PARAM_STR);
                    $edit->bindParam(':complemento', $complemento, PDO::PARAM_STR);
                    $edit->bindParam(':id', $id, PDO::PARAM_INT);
                    $result = $edit->execute();
                }

            if($result){
                header("location: modal.php");
            }else{
                $err[]='Something went wrong';
            }

        }

        if(isset($error)){ 
            foreach($error as $error){ 
              echo '<span class="alerts">'.$error.'</span>'; 
            }
        }
    ?>

        <form class="editar-endereco" name="edit-address" method="POST" enctype="multipart/form-data">
            <div class="input">
                <label>CEP</label><span class="obrigatorio">*</span><br>
                <input type="text" class="cep required" size="10px" name="cep" value="<?php echo $cep; ?>" required autofocus>
                <span class="span-required">CEP inválido</span>
            </div>
            <div class="input">
                <label>Estado</label><span class="obrigatorio">*</span><br>
                <input type="text" class="estado" size="10px" name="estado" value="<?php echo $estado; ?>">
            </div>
            <div class="input">
                <label>Cidade</label><span class="obrigatorio">*</span><br>
                <input type="text" class="cidade" size="20px" name="cidade" value="<?php echo $estado; ?>">
            </div>
            <div class="input">
                <label>Endereço</label><span class="obrigatorio">*</span><br>
                <input type="text" class="address" size="35px" name="rua" value="<?php echo $rua; ?>">
            </div>
            <div class="input">
                <label>Número</label><span class="obrigatorio">*</span><br>
                <input type="text" class="house-number required" size="10px" name="numero" value="<?php echo $numero; ?>">
                <span class="span-required">O campo número não pode estar vazio. Caso a residência não possua número, preencher com "s/n"</span>
            </div>
            <div class="input">
                <label>Complemento</label><br>
                <input type="text" class="complemento" size="20px" name="complemento" value="<?php echo $complemento; ?>">
            </div>
            <span class="alerts"></span>
            <div class="edit-botoes" style="text-align: center;">
                <button type="button" id="cancel" onclick="location = '/inDesign/pages/meu perfil/cobranca.php'">Cancelar</button>
                <button type="submit" id="save" name="save">Salvar alterações</button>
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
<script src="/inDesign/js/viacep.js"></script>
</body>
</html>