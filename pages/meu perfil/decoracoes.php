<?php
    require '../session/conexao.php';
    
    session_start();
    
    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
        require '../session/conexao.php';
        $id = $_SESSION['usuario'][0];
        $nome = $_SESSION['usuario'][1];
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
    <link rel="stylesheet" href="/inDesign/styles/decoracoes.css">
    <title>Minhas decorações</title>
</head>
<body>
<header>
    <img src="/inDesign/img/Wireframe PI 1.png" width="20%">
    <a class="a_header" href="../index.html">Início</a>
    <a class="a_header" href="../profissionais/index.html">Profissionais</a>
    <a class="a_header" href="../sobre.html">Sobre</a>
    <a class="a_header active" href="./decoracoes.php">Perfil</a>
    <a class="a_header" href="#">Quiz</a>
    <div class="container">
        <form action="" class="search-bar">
            <input type="text" placeholder="Pesquise aqui" name="q">
            <button type="submit"><img src="/img/lupa.png"></button>
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
            <img src="/inDesign/img/mini sofa roxo.svg">
            <a href="./decoracoes.php" class="active">Minhas decorações</a>
        </div>
        <div class="opcoes">
            <img src="/inDesign/img/moeda.svg">
            <a href="./cobranca.php">Dados de cobrança</a>
        </div>
        <div class="opcoes cadeado">
            <img src="/inDesign/img/cadeado.svg">
            <a href="/inDesign/pages/edit/seguranca.php">Senha e segurança</a>
        </div>
        <div class="opcoes">
            <a class="alterar-dados" href="../session/logout.php">Sair</a>
        </div>
    </article>
    <article class="box4">
        <h1 class="titulo-decoracoes">Decorações em andamento</h1>
        <div class="sem-decoracoes hidden">
            <p>você ainda não possui decorações em andamento</p>
        </div>
        <div class="decoracoes-andamento">
            <hr><div class="infos">
                <h3>cômodo e estilo</h3>
                <p>Data de início: 11/11/1111</p>
                <p>Previsão para entrega: 22/22/2222</p>
                <span>Decorador: </span><a href="#" class="decorador">Yuri sexy</a>
                <p>Valor: R$888888</p>
                <p>ID: 24344</p>
                <div class="detalhes">
                    <a href="#" class="chat">Chat com o decorador</a>
                    <img src="/inDesign/img/escritório.png" alt="">
                </div>
            </div>
            <hr><div class="infos">
                <h3>cômodo e estilo</h3>
                <p>Data de início: 11/11/1111</p>
                <p>Previsão para entrega: 22/22/2222</p>
                <span>Decorador: </span><a href="#" class="decorador">Yuri sexy</a>
                <p>Valor: R$888888</p>
                <p>ID: 24344</p>
                <div class="detalhes">
                    <a href="#" class="chat">Chat com o decorador</a>
                    <img src="/inDesign/img/escritório.png" alt="">
                </div>
            </div>
        </div>
        </div>
    </article>
    <article class="box5">
        <h1 class="titulo-decoracoes finalizadas">Decorações finalizadas</h1>
        <div class="no-decoracoes hidden">
            <p>você ainda não possui decorações finalizadas</p>
        </div>
        <div class="decoracoes-andamento finished">
            <hr><div class="infos-finalizada">
                <h3>cômodo e estilo</h3>
                <p>Data de início: 11/11/1111</p>
                <p>Data de entrega: 22/22/2222</p>
                <span>Decorador: </span><a href="#" class="decorador">Yuri sexy</a>
                <p>Valor: R$888888</p>
                <p>ID: 93248</p>
                <div class="detalhes">
                    <a href="#" class="chat">Chat com o decorador</a>
                    <img src="/inDesign/img/escritório.png" alt="">
                </div>
                <div class="avaliacao">
                    <h3>Sua avaliação:</h1>
                    <img src="/inDesign/img/4 estrelas.svg" alt="">
                </div>
            </div>
            <hr><div class="infos-finalizada">
                <h3>cômodo e estilo</h3>
                <p>Data de início: 11/11/1111</p>
                <p>Data de entrega: 22/22/2222</p>
                <span>Decorador: </span><a href="#" class="decorador">Yuri sexy</a>
                <p>Valor: R$888888</p>
                <p>ID: 12847</p>
                <div class="detalhes">
                    <a href="#" class="chat">Chat com o decorador</a>
                    <img src="/inDesign/img/escritório.png" alt="">
                </div>
                <div class="avaliacao">
                    <h3>Sua avaliação:</h1>
                    <img src="/inDesign/img/4 estrelas.svg" alt="">
                </div>
            </div>
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
                <a href="https://br.pinterest.com/" target="_blank"><img class="img_footer" src="/img/pin.png"></a>
                <a href="https://www.instagram.com/" target="_blank"><img class="img_footer" src="/img/instagram.png"></a>
                <a href="https://pt-br.facebook.com/" target="_blank"><img class="img_footer" src="/img/face.png"></a>
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
<script src="/js/active-header.js"></script>
<script src="/js/sem-decoracao.js"></script>
</body>
</html>