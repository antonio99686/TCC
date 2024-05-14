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

                    <h2>## <span class="danger"> ## </span></h2>
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

                <a href="perfil.php"class="active">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Perfil</h3>
                </a>
                <a href="calen">
                    <span class="material-icons-sharp">
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
            <h1>Sentinela da Fronteira</h1>
            <!-- Análises -->


            <!-- Fim das análises -->


            <!-- Fim da seção de novos usuários -->

            <!-- Tabela de pedidos recentes -->
            <div class="box">
                <h2>Dados Usuário</h2>
                <br>
                <div class="user">Nome: <?php echo $dados['nome'] ?></div>
                <br>
                <div class="user1">Telefone: <?php echo $dados['telefone'] ?></div>
                <br>
                <div class="user2">E-mail: <?php echo $dados['email'] ?></div>
                <br>
                <div class="user3">Senha: <?php echo $dados['senha'] ?></div>
                <br>
                <div class="user4">CPF: <?php echo $dados['CPF'] ?></div>
                <br>
                <div class="user5">Idade: <?php echo $dados['idade'] ?></div>
                <br>
                <div class="user6">Matricula: <?php echo $dados['matricula'] ?></div>
                <br>
                <div class="user7">Data de Nascimento: <?php echo $dados['datas'] ?></div>
                <br>
                <div class="user8">RG: <?php echo $dados['RG'] ?></div>
                <br>
                <div class="user9">Categoria: <?php echo $dados['categoria'] ?></div>
                <br>
                <div class="user10">Genero: <?php echo $dados['genero'] ?></div>
                <br>
                <div class="user11">Endereço: <?php echo $dados['endereco'] ?></div>
                <br>
                <div class="user12">Responsável: <?php echo $dados['responsavel'] ?></div>
                <br>
                <div class="user13">Data de Entrada: <?php echo $dados['data_entrada'] ?></div>
                <br>
                <div class="user14">Telefone Responsável: <?php echo $dados['tele_respon'] ?></div>
                <br>
                <div class="user15">Nome do(a) Dançarino(a): <?php echo $dados['nom_dan'] ?></div>
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
                    <img class="imgs" src="../img/icno.jpg">
                    <h2>Sentinela da Fronteira</h2>

                </div>
            </div>



        </div>


    </div>

    <script src="JavaScript/orders.js"></script>
    <script src="JavaScript/index.js"></script>
</body>

</html>