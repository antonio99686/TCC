<?php
session_start();
require_once "../conexao.php";
$conexao = conectar();

// Aguarda 1 segundos antes de redirecionar o usuário
sleep(1);

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Consulta SQL para obter as roupas do usuário
$sql_roupas_usuario = "SELECT * FROM roupas WHERE id_usuario = " . $_SESSION['id_usuario'];
$resultado_roupas_usuario = mysqli_query($conexao, $sql_roupas_usuario);

// Verifica se a consulta foi bem-sucedida
if (!$resultado_roupas_usuario) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- shortcut icon -->
    <link rel="shortcut icon" href="../../img/img/icon.png">
    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <title>Sentinela da fronteira</title>
</head>

<body>

    <div class="container">
        <!-- Seção da barra lateral -->
        <aside>
            <div class="toggle">
                <div class="logo">

                    <h2>Unindo Forças é <span class="danger">Bem Mais Facíl </span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="../dashboard.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="../participantes">
                    <span class="material-icons-sharp">
                        groups
                    </span>
                    <h3>Users</h3>
                </a>

                <a href="../perfil.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Perfil</h3>
                </a>
                <a href="../calen" target="_blank">
                    <span class="material-icons-sharp">
                        event
                    </span>
                    <h3>Calendario</h3>
                </a>
                <a href="../pagamento">
                    <span class="material-icons-sharp">
                        paid
                    </span>
                    <h3>Pagamento</h3>
                </a>
                <a href="../acessorios" class="active">
                    <span class="material-icons-sharp">
                        checkroom
                    </span>
                    <h3>Vestimentas</h3>
                </a>


                <a href="logout.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- Fim da seção da barra lateral -->

        <!-- Conteúdo principal -->
        <main>
            <h1>Vestimentas</h1>
            <!-- Análises -->


            <!-- Fim das análises -->


            <!-- Fim da seção de novos usuários -->

            <!-- Tabela de pedidos recentes -->
            <div class="box">
                <table>
                    <thead>
                        <tr>
                            <th>Roupa</th>
                            <th class="class">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultado_roupas_usuario)): ?>
                            <tr>
                                <td class="clas"><?php echo $row['nome']; ?></td>
                                <td>
                                    <?php if ($row['status_devolucao'] == 0): ?>
                                        <button type="button" class="btn_vermelho">Pendente</button>
                                    <?php else: ?>
                                        <button type="button" class="btn_verde">Entregue</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
            <!-- Fim dos pedidos recentes -->

        </main>
        <!-- Fim do conteúdo principal -->

        <!-- Seção Direita -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp ">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Olá, <b>Bem-Vindo(a)</b></p>
                        <small class="text-muted"><?php echo $dados['nome'] ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="../../img/perfil/<?php echo $dados['imagem'] ?>" alt="user">
                    </div>
                </div>

            </div>
            <!-- Fim da navegação -->

            <div class="user-profile">
                <div class="logo">
               
                    <h2></h2>

                </div>
            </div>



        </div>


    </div>

    <script src="../JavaScript/index.js"></script>
</body>

</html>