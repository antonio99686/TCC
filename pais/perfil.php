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
    <link rel="stylesheet" href="css/janela.css">
    <link rel="stylesheet" href="css/dashbord.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body style="background-color:rgb(161, 161, 161);">
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
                <a href="Dashboard.php">
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
            <img src="../img/<?php echo $dados['imagem'] ?>" alt="">
        </div>

        <!-- Conteúdo da página -->
        <section class="py-5">
            <div class="container">
                <div class="nome">
                    <br>
                    <br>
                    <br>
                    <h1 class="fw-light">Perfil</h1>
                    <p class="lead">
                        <?php echo $_SESSION['nome'] ?>

                    </p>
                </div>
            </div>
        </section>

        

    <!-- Scripts -->
    <script src="javascript/main.js"></script>
    <script src="javascript/script.js"></script>
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