<?php
// Aguarda 1 segundos antes de redirecionar o usuário
sleep(1);
session_start();
require_once "../conexao.php";
$conexao = conectar();

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
    <link rel="shortcut icon" href="../img/img/icon.png">
    <!-- Styles -->
    <link rel="stylesheet" href="css/perfil.css">
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
                <a href="dashboard.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="participantes">
                    <span class="material-icons-sharp">
                        groups
                    </span>
                    <h3>Users</h3>
                </a>

                <a href="perfil.php" class="active">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Perfil</h3>
                </a>
                <a href="calen" target="_blank">
                    <span class ="material-icons-sharp">
                        event
                    </span>
                    <h3>Calendario</h3>
                </a>
                <a href="pagamentos">
                    <span class="material-icons-sharp">
                        paid
                    </span>
                    <h3>Pagamento</h3>
                </a>
                <a href="acessorios">
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
            <h1>Perfil</h1>
            <!-- Análises -->


            <!-- Fim das análises -->


            <!-- Fim da seção de novos usuários -->

            <!-- Tabela de pedidos recentes -->
            <div class="box">
                <h2>Dados Usuário</h2>
                <br>
                <div class="user"><em><b>Nome:</b></em>  <?php echo $dados['nome'] ?></div>
                <br>
                <div class="user1"><em><b>Telefone:</b></em>  <?php echo $dados['telefone'] ?></div>
                <br>
                <div class="user2"><em><b>E-mail:</b></em>  <?php echo $dados['email'] ?></div>
                <br>
                <div class="user3"><em><b>Senha:</b></em>  <?php echo $dados['senha'] ?></div>
                <br>
                <div class="user4"><em><b>CPF:</b></em>  <?php echo $dados['CPF'] ?></div>
                <br>
                <div class="user5"><em><b>Idade:</b></em>  <?php echo $dados['idade'] ?></div>
                <br>
                <div class="user6"><em><b>Matricula:</b></em>  <?php echo $dados['matricula'] ?></div>
                <br>
                <div class="user7"><em><b>Data de Nascimento:</b></em>  <?php echo $dados['datas'] ?></div>
                <br>
                <div class="user8"><em><b>RG:</b></em> <?php echo $dados['RG'] ?></div>
                <br>
                <div class="user9"><em><b>Categoria:</b></em>  <?php echo $dados['categoria'] ?></div>
                <br>
                <div class="user10"><em><b>Genero:</b></em>  <?php echo $dados['genero'] ?></div>
                <br>
                <div class="user11"><em><b>Endereço:</b></em>  <?php echo $dados['endereco'] ?></div>
                <br>
                <div class="user12"><em><b>Responsável:</b></em>  <?php echo $dados['responsavel'] ?></div>
                <br>
                <div class="user13"><em><b>Data de Entrada:</b></em>  <?php echo $dados['data_entrada'] ?></div>
                <br>
                <div class="user14"><em><b>Telefone Responsável:</b></em>  <?php echo $dados['tele_respon'] ?></div>
                <br>
                

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
                    <span class="material-icons-sharp active">
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
                        <img src="../img/<?php echo $dados['imagem'] ?>" alt="user">
                    </div>
                </div>

            </div>
            <!-- Fim da navegação -->

            <div class="user-profile">
                <div class="logo">
                    <img class="imgs" src="../img/fundo.png">
                    <h2>Sentinela da Fronteira</h2>

                </div>
            </div>



        </div>


    </div>

    <script src="JavaScript/orders.js"></script>
    <script src="JavaScript/index.js"></script>
</body>

</html>