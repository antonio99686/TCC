<?php
session_start(); // Inicia a sessão para permitir o uso de variáveis de sessão
require_once "../../conexao.php"; // Inclui o arquivo de conexão com o banco de dados
$conexao = conectar(); // Estabelece a conexão com o banco de dados
sleep(1);
// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

// Obtém os dados do usuário logado
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql); // Prepara a consulta SQL
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id_usuario']); // Associa o parâmetro à consulta
mysqli_stmt_execute($stmt); // Executa a consulta preparada
$resultado = mysqli_stmt_get_result($stmt); // Obtém o resultado da consulta
$dados = mysqli_fetch_assoc($resultado); // Obtém os dados do usuário logado

// Verifica se foi feita uma requisição de busca de usuários
if (isset($_GET['nome_usuario'])) {
    $nome_usuario = $_GET['nome_usuario'];
    $stmt = mysqli_prepare($conexao, "SELECT id_usuario, nome FROM usuario WHERE nome LIKE 
    CONCAT('%', ?, '%') AND statuss = 1 ORDER BY nome ASC");
    mysqli_stmt_bind_param($stmt, "s", $nome_usuario); // Associa o parâmetro à consulta de busca
    mysqli_stmt_execute($stmt); // Executa a consulta preparada
    $resultado = mysqli_stmt_get_result($stmt); // Obtém o resultado da consulta

    $usuarios = [];
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($usuario = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $usuario; // Armazena os usuários encontrados no array $usuarios
        }
    }

    echo json_encode($usuarios); // Retorna os usuários encontrados como JSON e termina o script
    exit();
}





// Consulta para contar o número de usuários ativos
$sql_total_usuarios = "SELECT COUNT(*) as total FROM usuario WHERE statuss = 1";
$result_total_usuarios = $conexao->query($sql_total_usuarios);
$rows = $result_total_usuarios->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../../img/img/icon.png">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                <a href="../calen">
                    <span class="material-icons-sharp">
                        event
                    </span>
                    <h3>Calendario</h3>
                </a>
                <a href="../pagamentos">
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
                <a href="../logout.php">
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
            <h1>Pagamentos</h1>
            <!-- Análises -->
            <div class="analyse">
                <div class="sales">
                
                        <div class="status">
                            <div class="info">
                                <h3></h3>
                                <h1>    </h1>
                            </div>
                            <div class="progresss"></div>
                        </div>
                    
                </div>
                <div class="visits">
                
                        <div class="status">
                            <div class="info">
                                <h3></h3>
                                <h1></h1>
                            </div>
                            <div class="progresss"></div>
                        </div>
                
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Total de Usuários</h3>
                            <h1><?php echo $rows['total']; ?></h1>
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
            <!-- Fim das análises -->

            <!-- Tabela de pedidos recentes -->
            <div class="box">
                <div class="form-group">
                    <label for="nome_usuario">Digite o nome do usuário:</label>
                    <input type="text" class="form-control" id="nome_usuario" name="nome_usuario"
                        onkeyup="buscarUsuarios()">
                </div>
                <div id="resultados_busca"></div>

                
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
                        <img src="../../img/perfil/<?php echo $dados['imagem'] ?>" alt="user">
                    </div>
                </div>
            </div>
            <!-- Fim da navegação -->

            <div class="user-profile">
                <div class="logo">
                   
                </div>
            </div>
        </div>
    </div>
    <script src="../JavaScript/index.js"></script>
    <script>
function buscarUsuarios() {
    const nomeUsuario = document.getElementById('nome_usuario').value;
    if (nomeUsuario.length > 0) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `?nome_usuario=${nomeUsuario}`, true);
        xhr.onload = function () {
            if (this.status === 200) {
                const resultados = JSON.parse(this.responseText);
                let output = '<ul>';
                resultados.forEach(function (usuario) {
                    // Adiciona um evento onclick que abre um SweetAlert vazio ao clicar no nome do usuário
                    output += `<li><a href="#" onclick="abrirSweetAlert('${usuario.id_usuario}', '${usuario.nome}')">${usuario.nome}</a></li>`;
                });
                output += '</ul>';
                document.getElementById('resultados_busca').innerHTML = output;
            }
        };
        xhr.send();
    } else {
        document.getElementById('resultados_busca').innerHTML = '';
    }
}

// Função para abrir um SweetAlert vazio ao clicar no nome do usuário
function abrirSweetAlert(idUsuario, nomeUsuario) {
    Swal.fire({
        title: `Mensalidades`,
        html: `ID do Usuário: ${idUsuario}<br>Nome: ${nomeUsuario}`,
      
        showCancelButton: false,
        confirmButtonText: 'Fechar'
    });
}

    </script>


   