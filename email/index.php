<?php
session_start();
require_once "conexao.php";
$conexao = conectar();
sleep(1);
// Verifica se a sessão está iniciada e se o usuário está logado
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário utilizando prepared statements para evitar injeção de SQL
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verifica se a consulta foi bem-sucedida
if (!$resultado || mysqli_num_rows($resultado) == 0) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Obtém os dados do usuário
$dados = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../img/img/icon.png">
    <link rel="stylesheet" href="css/style.css">
    <title>Sentinela da Fronteira</title>
</head>

<body>
    <div class="container">
        <!-- Barra lateral -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Unindo Forças é <span class="danger">Bem Mais Fácil</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>

            <div class="sidebar">
                <a href="../coordenador/dashboard.php">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="../coordenador/participantes">
                    <span class="material-icons-sharp">groups</span>
                    <h3>Users</h3>
                </a>
                <a href="../coordenador/perfil.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Perfil</h3>
                </a>
                <a href="../coordenador/calen" target="_blank">
                    <span class="material-icons-sharp">event</span>
                    <h3>Calendário</h3>
                </a>
                <a href="../coordenador/pagamentos">
                    <span class="material-icons-sharp">paid</span>
                    <h3>Pagamento</h3>
                </a>
                <a href="../coordenador/acessorios">
                    <span class="material-icons-sharp">checkroom</span>
                    <h3>Vestimentas</h3>
                </a>
                <a href="email" class="active">
                    <span class="material-icons-sharp">email</span>
                    <h3>Email</h3>
                </a>
                <a href="logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- Fim da barra lateral -->

        <!-- Conteúdo principal -->
        <main>
            <h1>Sentinela da Fronteira</h1>
            <!-- Análises -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3></h3>
                            <h1></h1>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3></h3>
                            <h1></h1>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3></h3>
                            <h1></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim das análises -->

            <!-- Dados do Usuário -->
            <div class="box">
                <h1>Enviar Email</h1>
              
                <div class="notification">
                    <h2>Roupas pendentes</h2>
                    <a href="email.php">
                        <label for="enviar" class="form-control">ENVIAR</label></a>
                </div>
            </div>
            <div class="box">
                <h1>Enviar Email</h1>
              
                <div class="notification">
                    <h2>Mensalidades</h2>
                    <a href="../usuario/pagamento/email/email.php">
                        <label for="enviar" class="form-control">ENVIAR</label></a>
                </div>
            </div>
        </main>

        <!-- Seção Direita -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp light ">light_mode</span>
                    <span class="material-icons-sharp dark">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Olá, <b>Bem-Vindo(a)</b></p>
                        <small class="text-muted"><?php echo htmlspecialchars($dados['nome']); ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="../img/perfil/<?php echo htmlspecialchars($dados['imagem']); ?>" alt="user">
                    </div>
                </div>
            </div>

            <div class="user-profile">
                <div class="logo">
                   
                </div>
            </div>




        </div>
    </div>

    <script src="JavaScript/index.js"></script>




</body>

</html>