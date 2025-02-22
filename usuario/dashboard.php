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
    <link rel="shortcut icon" href="../img/img/user.png">
    <link rel="stylesheet" href="css/style.css">
    <title>Sentinela da Fronteira</title>
</head>

<body>
    <div class="container">
        <!-- Barra lateral -->
        <aside aria-label="Barra lateral de navegação">
            <div class="toggle">
                <div class="logo">
                    <h2>Unindo Forças é <span class="danger">Bem Mais Fácil</span></h2>
                </div>
                <button class="close" id="close-btn" aria-label="Fechar menu">
                    <span class="material-icons-sharp" aria-hidden="true">close</span>
                </button>
            </div>

            <nav class="sidebar" role="navigation">
                <a href="dashboard.php" class="active" aria-current="page">
                    <span class="material-icons-sharp" aria-hidden="true">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="participantes">
                    <span class="material-icons-sharp" aria-hidden="true">groups</span>
                    <h3>Usuário</h3>
                </a>
                <a href="perfil.php">
                    <span class="material-icons-sharp" aria-hidden="true">person_outline</span>
                    <h3>Perfil</h3>
                </a>
                <a href="calen" target="_blank">
                    <span class="material-icons-sharp" aria-hidden="true">event</span>
                    <h3>Calendário</h3>
                </a>
                <a href="pagamento">
                    <span class="material-icons-sharp" aria-hidden="true">paid</span>
                    <h3>Pagamento</h3>
                </a>
                <a href="acessorios">
                    <span class="material-icons-sharp" aria-hidden="true">checkroom</span>
                    <h3>Vestimentas</h3>
                </a>
                <a href="logout.php">
                    <span class="material-icons-sharp" aria-hidden="true">logout</span>
                    <h3>Logout</h3>
                </a>
            </nav>
        </aside>
        <!-- Fim da barra lateral -->

        <!-- Conteúdo principal -->
        <main>
            <h1>Sentinela da Fronteira</h1>
            <!-- Análises -->
           

            <!-- Dados do Usuário -->
            <section class="box" aria-labelledby="dados-usuario">
                <h2 id="dados-usuario">Dados do Usuário</h2>
                <div class="user-info">
                    <div><em><b>Nome:</b></em> <?php echo htmlspecialchars($dados['nome']); ?></div>
                    <div><em><b>Telefone:</b></em> <?php echo htmlspecialchars($dados['telefone']); ?></div>
                    <div><em><b>E-mail:</b></em> <?php echo htmlspecialchars($dados['email']); ?></div>
                    <div><em><b>CPF:</b></em> <?php echo htmlspecialchars($dados['CPF']); ?></div>
                    <div><em><b>Idade:</b></em> <?php echo htmlspecialchars($dados['idade']); ?></div>
                    <div><em><b>Data de Nascimento:</b></em> <?php echo htmlspecialchars(date('d/m/Y', strtotime($dados['datas']))); ?></div>
                </div>
            </section>
        </main>

        <!-- Seção Direita -->
        <div class="right-section">
            <div class="nav" aria-label="Navegação">
                <button id="menu-btn" aria-label="Abrir menu">
                    <span class="material-icons-sharp" aria-hidden="true">menu</span>
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
                        <img src="../img/perfil/<?php echo htmlspecialchars($dados['imagem']); ?>" alt="Foto de perfil do usuário">
                    </div>
                </div>
            </div>

            <div class="user-profile">
                <div class="logo">
                    <img class="imgs" src="../img/fundo.png" alt="Logotipo Sentinela da Fronteira">
                    <h2>Sentinela da Fronteira</h2>
                </div>
            </div>

           
        </div>
    </div>

    <script src="JavaScript/index.js"></script>
</body>

</html>
