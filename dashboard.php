<?php
session_start();
include("conexao.php");

// Verifica se o usuário não está logado
if (!empty ($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: login.php");
    exit();
}


// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário

$sql = "SELECT * FROM usuario WHERE id_usuario = " . $id_usuario;
var_dump($sql);

$resultado = mysqli_query($conexao, $sql);

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Obtém os dados do usuário
$dados = mysqli_fetch_assoc($resultado);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- código do cabeçalho  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashbord.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="shortcut icon" href="img/img/icon.png">
    <title>Sentinela da fronteira</title>
       <!-- Adicionando Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" media="screen"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</head>

<body>

<header class="navbar navbar-expand-lg navbar-light bg-light top" style="background-color: ;">
        <div class="container">
            <a class="navbar-brand">
                <img src="img/icno.jpg" class="imgs" height="50px" width="50px"> Sentinela da Fronteira
                <?php echo "<a href='index.php' class='btn btn-danger'>Sair</a>"; ?>
    </header>

    <nav class="menu-lateral">

        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div>
        <!--btn-expandir-->

        <ul>
            <li class="item-menu ativo">
                <a href="#">
                    <span class="icon"><i class="bi bi-house-door"></i></span>
                    <span class="txt-link">Home</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-columns-gap"></i></span>
                    <span class="txt-link">Dashboard</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="calen/index.php">
                    <span class="icon"><i class="bi bi-calendar3"></i></span>
                    <span class="txt-link">Agenda</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-gear"></i></span>
                    <span class="txt-link">Configurações</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-person-circle"></i></span>
                    <span class="txt-link">Conta</span>
                </a>
            </li>
        </ul>

    </nav><!--menu-lateral-->


    <!-- Seção para exibir os dados do usuário -->
    <section class="py-5">
        <div class="container">
            <br>
            <br>
            <br>
            <h1 class="fw-light">Bem-vindo(a)</h1>
            <p class="lead">
                <?php echo $dados['nome']; ?>
            </p>
            <img src="img/<?php echo $dados['imagem']; ?>" height="190px" width="150px">
        </div>
    </section>

    <!-- Seção para exibir informações do usuário -->
    <div class="infor">
        <h2> DADOS</h2>

        <?php
        echo "Nome: " . $dados['nome'] . "<br>";
        echo "E-mail: " . $dados['email'] . "<br>";
        echo "Matrícula: " . $dados['usuario'] . "<br>";
        echo "Data de Nascimento: " . $dados['datas'] . "<br>";
        echo "Endereço: " . $dados['endereco'] . "<br>";
        echo "Responsável: " . $dados['responsavel'] . "<br>";
        echo "Data de Entrada: " . $dados['data_entrada'] . "<br>";
        echo "Telefone Responsável: " . $dados['tele_respon'] . "<br>";
        ?>

    </div>

    <section class="hero-section">
        <div class="card-grid">
            <a class="card" href="pagamento/index.php">
                <div class="card__background"
                    style="background-image: url(https://www.gruporecovery.com/wp-content/uploads/2023/09/MicrosoftTeams-image-1.png)">
                </div>
                <div class="card__content">
                    <p class="card__category">Pagamentos</p>
                    <h3 class="card__heading"> Pagamentos Realizados </h3>
                </div>
            </a>
            <a class="card" href="calen/index.php">
                <div class="card__background"
                    style="background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEitU-PVqEDxdQechVNbSX4tQL09DoAPQjnr9hdDgItFrHfmqohOlvJrroneorrHFzRJwjxNeQox7wMBfYFERrJsMg6AnhYVIx__YvBxIu0xwODsL0fn9GgFWXzqrV5na3fgg66G34lh4rs/s1600/CIMG0108.JPG)">
                </div>
                <div class="card__content">
                    <p class="card__category">Reuniões</p>
                    <h3 class="card__heading"> Reuniões Marcadas</h3>
                </div>
            </a>
            <a class="card" href="acessorios/index.php">
                <div class="card__background"
                    style="background-image: url(https://www.dancastipicas.com/wp-content/uploads/2018/11/dan%C3%A7as-t%C3%ADpicas-da-regi%C3%A3o-sul-do-brasil-600x381.jpg)">
                </div>
                <div class="card__content">
                    <p class="card__category">Roupas</p>
                    <h3 class="card__heading"> Vestimentas</h3>
                </div>
                </li>
                <a class="card" href="participantes/index.php">
                    <div class="card__background"
                        style="background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhjBg2Sx6qaB7z73rXl3TaDr9jnqt7V7sV6M7WHoM__eA_qXn7mTIYqiFjNHN4MHCs6rOEpxOY7orHTvckT6wxUba77D-6gFjQYhOkh0pgzZFvXEDr7IXjfF0BWVPm55OZpE-18JusWEWjK/s1600/PAR.JPG)">
                    </div>
                    <div class="card__content">
                        <p class="card__category">Participantes</p>
                        <h3 class="card__heading"> Participantes</h3>
                    </div>
                </a>
                <div>


                    <!-- Footer -->

    </section>

    <footer class="text-center text-white" style="background-color: #2d3548;">

<div class="container p-4 pb-0">

    <section class="">
        <p class="d-flex justify-content-center align-items-center">
            <span class="me-3">
                <a href="https://www.instagram.com/ptgsentinelaoficial/">
                    <img src="img/img/instagram.png" height="20px" width="20px"></a>

                <a
                    href="https://www.facebook.com/pages/Piquete%20Sentinela%20Da%20Fronteira/843171032373964/photos/?locale=pt_BR">
                    <img src="img/img/facebook.png" height="20px" width="20px"></a>


            </span>

            <!-- <button data-mdb-ripple-init type="button" class="btn btn-outline-light btn-rounded">

                </button>-->
        </p>

    </section>

</div>



<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    Sentinela da Fronteira

</div>

</footer>



<script src="java/dash.js"></script>

</body>

</html>
