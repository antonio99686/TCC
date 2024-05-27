<?php
session_start();
include ("conexao.php");

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

$mensagem_alerta = "";

// Processa o formulário de adição de recado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $mensagem = $_POST['mensagem'];

    // Consulta SQL para inserir o recado
    $sql_avisos = "INSERT INTO avisos (titulo, mensagem) VALUES (?, ?)";
    $stmt_avisos = mysqli_prepare($conexao, $sql_avisos);
    mysqli_stmt_bind_param($stmt_avisos, "ss", $titulo, $mensagem);

    if (mysqli_stmt_execute($stmt_avisos)) {
        $mensagem_alerta = "<script>
            Swal.fire({
                icon: 'success',
                title: 'Recado adicionado com sucesso!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    } else {
        $mensagem_alerta = "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao adicionar recado!',
                text: '" . mysqli_error($conexao) . "',
                showConfirmButton: true
            });
        </script>";
    }
}



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../img/img/icon.png">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sentinela da Fronteira</title>
</head>

<body>
    <div class="container">
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
                <a href="dashboard.php" class="active">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="participantes">
                    <span class="material-icons-sharp">groups</span>
                    <h3>Users</h3>
                </a>
                <a href="perfil.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Perfil</h3>
                </a>
                <a href="calen" target="_blank">
                    <span class="material-icons-sharp">event</span>
                    <h3>Calendário</h3>
                </a>
                <a href="pagamentos">
                    <span class="material-icons-sharp">paid</span>
                    <h3>Pagamento</h3>
                </a>
                <a href="acessorios">
                    <span class="material-icons-sharp">checkroom</span>
                    <h3>Vestimentas</h3>
                </a>
                <a href="logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <main>
            <h1>Sentinela da Fronteira</h1>
            <div class="analyse">
                <div class="sales">
                    <a href="form/formcad.php">
                        <div class="status">
                            <div class="info">
                                <h3>Cadastro</h3>
                                <h1>Cadastre o Usuário</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="visits">
                    <a href="form/lista.php">
                        <div class="status">
                            <div class="info">
                                <h3>Editar</h3>
                                <h1>Edite o Usuário</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="searches">
                    <a href="form/roupa.php">
                        <div class="status">
                            <div class="info">
                                <h3>Roupa</h3>
                                <h1>Cadastro da Roupa do Usuário</h1>
                            </div>
                        </div>

                    </a>
                </div>
            </div>
            <div class="box">
                <h2>Dados Usuário</h2>
                <br>
                <div class="user"><em>Nome:</em> <?php echo htmlspecialchars($dados['nome']); ?></div>
                <br>
                <div class="user1"><em>Telefone:</em> <?php echo htmlspecialchars($dados['telefone']); ?></div>
                <br>
                <div class="user2"><em>E-mail:</em> <?php echo htmlspecialchars($dados['email']); ?></div>
                <br>
                <div class="user3"><em>Senha:</em> <?php echo htmlspecialchars($dados['senha']); ?></div>
                <br>
                <div class="user4"><em>CPF:</em> <?php echo htmlspecialchars($dados['CPF']); ?></div>
                <br>
                <div class="user5"><em>Idade:</em> <?php echo htmlspecialchars($dados['idade']); ?></div>
                <br>
                <div class="user6"><em>Matrícula:</em> <?php echo htmlspecialchars($dados['matricula']); ?></div>
                <br>
                <div class="user7"><em>Data de Nascimento:</em> <?php echo htmlspecialchars($dados['datas']); ?></div>
            </div>
        </main>
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Olá, <b>Bem-Vindo(a)</b></p>
                        <small class="text-muted"><?php echo htmlspecialchars($dados['nome']); ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="../img/<?php echo htmlspecialchars($dados['imagem']); ?>" alt="user">
                    </div>
                </div>
            </div>
            <div class="user-profile">
                <div class="logo">
                    <img class="imgs" src="../img/icno.jpg">
                    <h2>Sentinela da Fronteira</h2>
                </div>
            </div>
            <div class="reminders">
                <div class="notification">
                    <h1>Adicionar Recado</h1>
                    <form method="post" action="dashboard.php">
                        <label for="titulo">Título:</label><br>
                        <input type="text" id="titulo" name="titulo" required><br>
                        <label for="mensagem">Mensagem:</label><br>
                        <textarea id="mensagem" name="mensagem" required></textarea><br>
                        <input type="submit" class="button" value="Adicionar">

                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php echo $mensagem_alerta; ?>
    <script src="JavaScript/orders.js"></script>
    <script src="JavaScript/index.js"></script>
</body>

</html>