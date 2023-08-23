<?php
    require '../session/conexao.php';
    
    session_start();
    
    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
        require '../session/conexao.php';
        $id = $_SESSION['usuario'][0];
        $nome = $_SESSION['usuario'][1];
        $cpf = $_SESSION['usuario'][2];
        $telefone = $_SESSION['usuario'][5];
        $foto = $_SESSION['usuario'][12];
    }else{
        echo "<script> location = '../session/login.php' </script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/inDesign/styles/recebimento.css">
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
            <button type="submit"><img src="/inDesign/img/lupa.png"></button>
        </form>
    </div>
</header>

<section class="profile-container">
    <article class="box1">
        <div class="user">
        <?php if ((!empty($foto)) and (!file_exists("/inDesign/pages/edit/pfp/$id/$foto"))) {
            echo "<img src='/inDesign/pages/edit/pfp/$id/$foto' width='128' height='128' style='border-radius: 100%'>";
        } else {
            echo "<img src='/inDesign/img/default_pfp.png' width='128'>";
        } ?>
            <h2 class="nome"><?php echo $nome; ?></h2>
        </div>
        <div class="opcoes cadeado">
            <img src="/inDesign/img/mala.svg">
            <a href="./index.php">Área do decorador</a>
        </div>
        <div class="opcoes">
            <img src="/inDesign/img/user avatar.svg">
            <a href="./perfil.php">Meu perfil</a>
        </div>
        <div class="opcoes">
            <img src="/inDesign/img/mini sofa.svg">
            <a href="./decoracoes.php">Minhas decorações</a>
        </div>
        <div class="opcoes">
            <img src="/inDesign/img/moeda roxa.svg">
            <a href="./recebimento.php" class="active">Dados de recebimento</a>
        </div>
        <div class="opcoes">
            <a class="alterar-dados" href="../session/logout.php">Sair</a>
        </div>
    </article>
    <article class="box-recebimento">
        <div class="titulos-recebimento">
            <h1 class="h1-decorador">Dados de recebimento</h1>
            <hr>
            <h2 class="subtexto">Seus dados de recebimento:</h2>
        </div>
        <div class="dados-recebimento">
            <div class="dado">
                <img class="dado-img" src="/inDesign/img/pix.svg">
                <h3 class="dado-titulo">Pix</h3>
                <span class="dado-texto">Chave pix: Celular</span>
                <span><?php 
                function formataTelefone($telefone){
                    $formata = substr($telefone, 0, 2);
                    $formata_2 = substr($telefone, 3, 5);
                    $formata_3 = substr($telefone, 4, 4);
                    return "(".$formata.") " . $formata_2 . "-". $formata_3;
                 }
                echo formataTelefone($telefone); ?></span>
            </div>
            <div class="dado">
                <img class="dado-img" src="/inDesign/img/qr code.svg" alt="">
                <h3 class="dado-titulo">QR code</h3>
                <span class="dado-texto">Gerado na hora</span>
            </div>
            <div class="dado">
                <img class="dado-img" src="/inDesign/img/boleto.svg" alt="">
                <h3 class="dado-titulo">Boleto bancário</h3>
                <span class="dado-texto">Gerado na hora</span>
            </div>
            <div class="dado">
                <img class="dado-img" src="/inDesign/img/cartao crédito.svg" alt="">
                <h3 class="dado-titulo">Cartão de crédito</h3>
                <span class="dado-texto">Parcelas de até 18x</span>
            </div>
            <div class="dado">
                <img class="dado-img" src="/inDesign/img/transferencia ted.svg" alt="">
                <h3 class="dado-titulo">Transferência bancária</h3>
                <span class="dado-texto">Nome: <?php echo $nome ?></span>
                <span class="dado-texto">CPF/CNPJ: <?php 
                function formatCnpjCpf($cpf){
                  $CPF_LENGTH = 11;
                  $cnpj_cpf = preg_replace("/\D/", '', $cpf);
                  
                  if (strlen($cnpj_cpf) === $CPF_LENGTH) {
                    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
                  } 
                  
                  return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
                }
                echo formatCnpjCpf($cpf); ?></span>
                <span class="dado-texto">Agência: 0001 | Conta: 4985768-2 <br> Banco: 336 - Banco C6 S.A.</span>
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
<script src="/js/active-header.js"></script>
<script src="/js/sem-decoracao.js"></script>
</body>
</html>