<?php
session_start();
require_once "../../conexao.php";
$conexao = conectar();
sleep(1);

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Obtém os dados do usuário logado
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_assoc($resultado);

// Verifica se foi feita uma requisição de busca de usuários
if (isset($_GET['nome_usuario'])) {
    $nome_usuario = $_GET['nome_usuario'];
    $sql = "SELECT id_usuario, nome FROM usuario WHERE nome LIKE '%$nome_usuario%' AND statuss = 1 ORDER BY nome ASC";
    $resultado = mysqli_query($conexao, $sql);

    $usuarios = [];
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($usuario = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $usuario;
        }
    }

    echo json_encode($usuarios);
    exit();
}

// Verifica se foi feita uma requisição de busca de mensalidades
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
    $sql = "SELECT mes, pago FROM mensalidades WHERE usuario_id = $id_usuario";
    $resultado = mysqli_query($conexao, $sql);

    $mensalidades = [];
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($mensalidade = mysqli_fetch_assoc($resultado)) {
            $mensalidades[] = $mensalidade;
        }
    }

    echo json_encode($mensalidades);
    exit();
}

$sql_total_usuarios = "SELECT COUNT(*) as total FROM usuario WHERE statuss = 1";
$result_total_usuarios = mysqli_query($conexao, $sql_total_usuarios);
$rows = mysqli_fetch_assoc($result_total_usuarios);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../../img/img/icon.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pag.css">
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
                <a href="../../email">
                    <span class="material-icons-sharp">email</span>
                    <h3>Email</h3>
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
                            <h1></h1>
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
                    <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" onkeyup="buscarUsuarios()">
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
                </div>
            </div>
        </div>
    </div>
    <script src="../JavaScript/index.js"></script>

    <script>
    function buscarUsuarios() {
        const nomeUsuario = document.getElementById('nome_usuario').value;
        console.log(`Buscando usuários com o nome: ${nomeUsuario}`);
        if (nomeUsuario.length > 0) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `?nome_usuario=${nomeUsuario}`, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    try {
                        const resultados = JSON.parse(this.responseText);
                        let output = '<ul>';
                        resultados.forEach(function (usuario) {
                            output += `<li><a href="#" onclick="buscarMensalidades(${usuario.id_usuario}, '${usuario.nome}')">${usuario.nome}</a></li>`;
                        });
                        output += '</ul>';
                        document.getElementById('resultados_busca').innerHTML = output;
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        console.error('Response was:', this.responseText);
                    }
                }
            };
            xhr.send();
        } else {
            document.getElementById('resultados_busca').innerHTML = '';
        }
    }

    function buscarMensalidades(idUsuario, nomeUsuario) {
        console.log(`Buscando mensalidades para o usuário: ${nomeUsuario} (ID: ${idUsuario})`);
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `?id_usuario=${idUsuario}`, true);
        xhr.onload = function () {
            if (this.status === 200) {
                try {
                    const mensalidades = JSON.parse(this.responseText);
                    let content = `<h3>Mensalidades de ${nomeUsuario}</h3>`;
                    if (mensalidades.length > 0) {
                        content += "<table><tr><th>Mês</th><th>Status</th></tr>";
                        mensalidades.forEach(function (mensalidade) {
                            content += `<tr><td>${mensalidade.mes}</td><td>${mensalidade.pagamento ? 'Pago' : 'Não Pago'}</td></tr>`;
                        });
                        content += "</table>";
                    } else {
                        content += "<p>Não há pendências.</p>";
                    }
                    abrirSweetAlert(content);
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response was:', this.responseText);
                }
            }
        };
        xhr.send();
    }

    function abrirSweetAlert(content) {
        Swal.fire({
            title: 'Detalhes das Mensalidades',
            html: content,
            icon: 'info',
            showCloseButton: true
        });
    }
    </script>
</body>
</html>
