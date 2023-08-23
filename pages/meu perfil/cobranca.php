<?php
    session_start();
    ob_start();
    
    require_once '../session/conexao.php';
    
    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){

        $id = $_SESSION['usuario'][0];
        $nome = $_SESSION['usuario'][1];
        $endereco = $_SESSION['usuario'][6];
        $numero = $_SESSION['usuario'][7];
        $cep = $_SESSION['usuario'][8];
        $estado = $_SESSION['usuario'][9];
        $cidade = $_SESSION['usuario'][10];
        $complemento = $_SESSION['usuario'][11];
        $foto = $_SESSION['usuario'][12];
    }else{
        header("location: ../session/login.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/inDesign/styles/cobranca.css">
    <title>Dados de cobrança</title>
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

<section class="profile-container">
    <article class="box1">
        <div class="user">
        <?php if ((!empty($foto)) and (!file_exists("/inDesign/pages/edit/pfp/$id/$foto"))) {
            echo "<img src='/inDesign/pages/edit/pfp/$id/$foto' width='128' height='128' style='border-radius: 80%'>";
        } else {
            echo "<img src='/inDesign/img/default_pfp.png' width='128'>";
        } ?>
            <h2 class="nome"><?php echo $nome; ?></h2>
        </div>
        <div class="opcoes">
            <img src="/inDesign/img/user avatar.svg">
            <a href="./index.php">Meu perfil</a>
        </div>
        <div class="opcoes">
            <img src="/inDesign/img/mini sofa.svg">
            <a href="./decoracoes.php">Minhas decorações</a>
        </div>
        <div class="opcoes">
            <img src="/inDesign/img/moeda roxa.svg">
            <a href="./cobranca.php" class="active">Dados de cobrança</a>
        </div>
        <div class="opcoes cadeado">
            <img src="/inDesign/img/cadeado.svg">
            <a href="/inDesign/pages/edit/seguranca.php">Senha e segurança</a>
        </div>
        <div class="opcoes">
            <a class="alterar-dados" href="../session/logout.php">Sair</a>
        </div>
    </article>
    <article class="box6">
        <h1>Dados de cobrança</h1>
            <div class="enderecos">
                <p>Endereço:</p><span><?php echo $endereco; ?></span><br><br>
                <p>Número:</p><span><?php echo $numero; ?></span><br><br>
                <p>CEP:</p><span><?php echo $cep; ?></span><br><br>
                <p>Cidade:</p><span><?php echo $cidade; ?></span><br><br>
                <p>Estado:</p><span><?php echo $estado; ?></span><br><br>
                <p>Complemento:</p><span><?php echo $complemento; ?></span><br><br>
            </div>
            <div class="botoes-cobranca">
                <button type="button" class="edit" onclick="location = '/inDesign/pages/edit/editar-endereco.php'">Editar</button>
            </div>
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
<script src="/inDesign/js/active-header.js"></script>
</body>
</html>