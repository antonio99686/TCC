<?php
session_start();
include ("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
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

 // Consulta SQL para obter todos os pagamentos
 $sql = "SELECT * FROM pagamentos";
 $resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/img/icon.png">
    <title>Sentinela da Fronteira</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                    
                    </span>
                    <span class="title">Sentinela da Fronteira</span>
                </a>
            </li>

            <li>
                <a href="../Dashboard.php">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="../perfil.php">
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
            <p>Você realmente deseja sair?</p>
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

        <div class="user" onclick="document.getElementById('fileInput').click();">
            <img src="../img/<?php echo $dados['imagem'] ?>" alt="">
            <input type="file" id="fileInput" style="display: none;" onchange="updateProfilePicture(this)">
        </div>

        <!-- Cards -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Card 1</div>
                </div>
                <div class="iconBx">
                    <ion-icon name=""></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Card 2</div>
                </div>
                <div class="iconBx">
                    <ion-icon name=""></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Card 3</div>
                </div>
                <div class="iconBx">
                    <ion-icon name=""></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Card 4</div>
                </div>
                <div class="iconBx">
                    <ion-icon name=""></ion-icon>
                </div>
            </div>
        </div>

        
    </div>

   
   
</body>
</html>

    <!-- Scripts -->
    <script src="JavaScript/main.js"></script>
    <script src="JavaScript/dash.js"></script>
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
    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>