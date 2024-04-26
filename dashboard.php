<?php
session_start();
include ("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION)) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário
$sql = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION['id_usuario'];
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/img/icon.png">
    <title>Sentinela da fronteira</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashbord.css">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body>
    <!-- Navigation -->
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="##"></ion-icon>
                    </span>
                    <span class="title"> Sentinela da Fronteira </span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

        
            <li>
                <a href="perfil.php">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Perfil</span>
                </a>
            </li>

            <li>
                <a onclick="confirmLogout()">
                    <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sair</span>
                </a>
            </li>

        </ul>
    </div>

    <!-- Modal -->
    <div id="modal-container" class="modal-container">
        <div class="modal">
            <h1><?php echo $_SESSION['nome'] ?></h1>
            <p> Você realmente deseja sair?</p>
            <button onclick="confirmLogout()">Sair</button>
            <button onclick="cancelLogout()">Cancelar</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <div class="user">
            <img src="img/<?php echo $dados['imagem'] ?>" alt="">
        </div>

        <!-- Conteúdo da página -->
        <section class="py-5">
            <div class="container">
                <div class="nome">
                    <br>
                    <br>
                    <br>
                    <h1 class="fw-light">Bem-vindo(a)</h1>
                    <p class="lead">
                        <?php echo $_SESSION['nome'] ?>

                    </p>
                </div>
            </div>
        </section>

        <div class="cardss">
            <!-- Seção de Cards -->
            <section class="hero-section">
                <div class="card-grid">
                    <a class="card" href="pagamento">
                        <div class="card__background"
                            style="background-image: url(https://controlefinanceiro.granatum.com.br/wp-content/uploads/2022/09/header-boleto.png)">
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
                    </a>
                    <a class="card" href="participantes/index.php">
                        <div class="card__background"
                            style="background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhjBg2Sx6qaB7z73rXl3TaDr9jnqt7V7sV6M7WHoM__eA_qXn7mTIYqiFjNHN4MHCs6rOEpxOY7orHTvckT6wxUba77D-6gFjQYhOkh0pgzZFvXEDr7IXjfF0BWVPm55OZpE-18JusWEWjK/s1600/PAR.JPG)">
                        </div>
                        <div class="card__content">
                            <p class="card__category">Participantes</p>
                            <h3 class="card__heading"> Participantes</h3>
                        </div>
                    </a>
                </div>
            </section>
        </div>
    </div>

    <!-- Scripts -->
    <script src="JavaScript/main.js"></script>
    <script src="JavaScript/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: '<?php echo $_SESSION['nome'] ?>',
                text: "Você realmente deseja sair?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, sair',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }

        function cancelLogout() {
            Swal.fire({
                title: 'Operação cancelada',
                text: 'Você permanecerá na página atual',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }
    </script>

    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>