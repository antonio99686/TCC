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

// Consulta SQL para obter os dados da tabela Avisos
$sql_avisos = "SELECT * FROM avisos ORDER BY data DESC";
$result_avisos = mysqli_query($conexao, $sql_avisos);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="img/img/icon.png">
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
                <a href="pagamento">
                    <span class="material-icons-sharp">money</span>
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
                <h2>Dados Usuário</h2>
                <div class="user-info">
                    <div><em><b>Nome:</b></em> <?php echo htmlspecialchars($dados['nome']); ?></div>
                    <div><em><b>Telefone:</b></em> <?php echo htmlspecialchars($dados['telefone']); ?></div>
                    <div><em><b>E-mail:</b></em> <?php echo htmlspecialchars($dados['email']); ?></div>
                    <div><em><b>Senha:</b></em> <?php echo htmlspecialchars($dados['senha']); ?></div>
                    <div><em><b>CPF:</b></em> <?php echo htmlspecialchars($dados['CPF']); ?></div>
                    <div><em><b>Idade:</b></em> <?php echo htmlspecialchars($dados['idade']); ?></div>
                    <div><em><b>Matrícula:</b></em> <?php echo htmlspecialchars($dados['matricula']); ?></div>
                    <div><em><b>Data de Nascimento:</b></em> <?php echo htmlspecialchars($dados['datas']); ?></div>
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
                    <span class="material-icons-sharp light active">light_mode</span>
                    <span class="material-icons-sharp dark">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Olá, <b>Bem-Vindo(a)</b></p>
                        <small class="text-muted"><?php echo htmlspecialchars($dados['nome']); ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="img/<?php echo htmlspecialchars($dados['imagem']); ?>" alt="user">
                    </div>
                </div>
            </div>

            <div class="user-profile">
                <div class="logo">
                    <img class="imgs" src="img/fundo.png">
                    <h2>Sentinela da Fronteira</h2>
                </div>
            </div>
            <div class="reminders">
                <div id="avisosContainer" class="notification">
                    <h2>Avisos</h2>
                    <?php
                    if (mysqli_num_rows($result_avisos) > 0) {
                        while ($aviso = mysqli_fetch_assoc($result_avisos)) {
                            echo "<div class='aviso'>";
                            echo "<h3>" . htmlspecialchars($aviso['titulo']) . "</h3>";
                            echo "<p>" . htmlspecialchars($aviso['mensagem']) . "</p>";
                            echo "<small>" . htmlspecialchars($aviso['data']) . "</small>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Nenhum aviso disponível.</p>";
                    }
                    ?>
                </div>
            </div>



        </div>
    </div>
    <script src="JavaScript/orders.js"></script>
    <script src="JavaScript/index.js"></script>
    <script>
        // Função para fazer os avisos passarem automaticamente
        function passarAvisos() {
            var avisos = document.querySelectorAll('.aviso');
            var index = 0;

            function exibirProximoAviso() {
                // Oculta o aviso atual
                avisos[index].style.display = 'none';

                // Incrementa o índice para mostrar o próximo aviso
                index = (index + 1) % avisos.length;

                // Mostra o próximo aviso
                avisos[index].style.display = 'block';

                // Chama a função novamente após 5 segundos
                setTimeout(exibirProximoAviso, 3000); //  o valor para ajustar o tempo entre os avisos (em milissegundos)
            }

            // Exibe o primeiro aviso
            avisos[index].style.display = 'block';

            // Chama a função para exibir o próximo aviso após 5 segundos
            setTimeout(exibirProximoAviso, 3000); //  o valor para ajustar o tempo entre os avisos (em milissegundos)
        }

        // Chama a função quando a página é carregada
        window.onload = passarAvisos;
    </script>



</body>

</html>