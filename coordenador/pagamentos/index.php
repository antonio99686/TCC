<?php
session_start();
require_once "../../conexao.php";
$conexao = conectar();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário
$sql_usuario = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
$resultado_usuario = mysqli_query($conexao, $sql_usuario);

// Verifica se a consulta foi bem-sucedida
if (!$resultado_usuario) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Obtém os dados do usuário
$dados = mysqli_fetch_assoc($resultado_usuario);
// Verifica a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Consulta para contar o número de usuários
$sql = "SELECT COUNT(*) as total FROM usuario";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    // Produza os dados
    $row = $result->fetch_assoc();

} else {
    echo "Nenhum usuário encontrado.";
}

$conexao->close();

// Aguarda 1 segundos antes de redirecionar o usuário
sleep(1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../../img/img/icon.png">
    <link rel="stylesheet" href="css/style.css">
    <title>Sentinela da Fronteira</title>
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
                <a href="../pagamentos" class="active">
                    <span class="material-icons-sharp">
                        paid
                    </span>
                    <h3>Pagamento</h3>
                </a>
                <a href="../acessorios">
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
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Pagamentos</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Total em Banco</h3>
                            <h1>R$65,024</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+81%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Total de Pagamentos</h3>
                            <h1>2</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>0,2%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Total de Usuários</h3>
                            <h1> <?php echo "" . $row["total"];?></h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>100%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->

            <!-- New Users Section -->
            <div class="new-users">
                <h2>Mensalidades Pendentes</h2>
                <div class="user-list">
                    <div class="user">
                        <img src="../../img/<?php echo $dados['imagem'] ?>" alt="user">
                        <h2><?php echo $dados['nome'] ?></h2>
                        <p>Falta pagar o mês de: ABRIL </p>
                    </div>

                </div>
            </div>
            <!-- End of New Users Section -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Recentes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome do Usuário</th>
                            <th>Quantidade</th>
                            <th>Forma de Pagamento</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <td> Antonio Carlos Mattes Mongelo</td>
                        <td> R$: 30,00</td>
                        <td> PIX </td>
                        <td> Pago</td>
                    </tbody>
                </table>

            </div>
            <!-- End of Recent Orders -->

        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
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
                        <img src="../../img/<?php echo $dados['imagem'] ?>" alt="user">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->


            <div class="user-profile">
                <div class="logo">
                    <img class="imgs" src="../../img/fundo.png">
                    <h2>Sentinela da Fronteira</h2>

                </div>
            </div>


        </div>


    </div>


    <script src="JavaScript/index.js"></script>
    
    <script>
        function atualizarCo    ntagem() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("contagem").innerHTML = this.responseText;
                }
            };
            
        }
333
        setInterval(atualizarContagem, 5000); // Atualiza a cada 5 segundos
        window.onload = atualizarContagem; // Atualiza ao carregar a página
    </script>


</body>

</html>