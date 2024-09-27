<?php
session_start();
require_once "../../conexao.php";
$conexao = conectar();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Obtém os dados do usuário logado
$id_usuario = $_SESSION['id_usuario'];

// Obtém dados do usuário logado com proteção contra SQL Injection
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$dados = $resultado->fetch_assoc();

// Verifica se foi feita uma requisição de busca de usuários
if (isset($_GET['nome_usuario'])) {
    $nome_usuario = $_GET['nome_usuario'];

    // Busca usuários com proteção contra SQL Injection
    $sql = "SELECT id_usuario, nome FROM usuario WHERE nome LIKE ? AND statuss = 1 ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
    $search_term = '%' . $nome_usuario . '%';
    $stmt->bind_param('s', $search_term);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $usuarios = [];
    while ($usuario = $resultado->fetch_assoc()) {
        $usuarios[] = $usuario;
    }

    echo json_encode($usuarios);
    exit();
}

// Verifica se foi feita uma requisição de busca de mensalidades
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    // Busca mensalidades com proteção contra SQL Injection
    $sql = "SELECT id, mes, pago, comprovante FROM mensalidades WHERE usuario_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $mensalidades = [];
    while ($mensalidade = $resultado->fetch_assoc()) {
        $mensalidades[] = $mensalidade;
    }

    echo json_encode($mensalidades);
    exit();
}

// Consulta para obter o total de usuários
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
<style>
    .download {
        color: black;
    }
    .download:hover {
        color: red;
    }
    .download.disabled {
    color: gray;
    cursor: not-allowed;
    text-decoration: none;
}

</style>
<body>
    <div class="container">
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

        <main>
            <h1>Pagamentos</h1>
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
                            <h3></h3>
                            
                            <h1></h1>
                        </div>
                        <div class="progresss">
                           >
                            <div class="percentage">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="form-group">
                    <label for="nome_usuario">Digite o nome do usuário:</label>
                    <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" onkeyup="buscarUsuarios()">
                </div>
                <div id="resultados_busca"></div>
            </div>
        </main>

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
                    content += "<table><tr><th>Mês</th><th>Status</th><th>Comprovante</th></tr>";
                    mensalidades.forEach(function (mensalidade) {
                        const comprovanteLink = mensalidade.comprovante ? 
                            `download_comprovante.php?id=${mensalidade.id}` : '#';
                        const status = mensalidade.pago == 1 ? 'Pago' : 'Não Pago';

                        // Se não estiver pago, desativar o link de download
                        const downloadLink = mensalidade.pago == 1 && mensalidade.comprovante ? 
                            `<a href="${comprovanteLink}" class="download">Download</a>` : 
                            '<span class="download disabled">Download indisponível</span>';
                        
                        content += `<tr>
                            <td>${mensalidade.mes}</td>
                            <td>${status}</td>
                            <td>${downloadLink}</td>
                        </tr>`;
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

document.addEventListener('click', function(event) {
    if (event.target.matches('.download')) {
        event.preventDefault();
        const link = event.target.getAttribute('href');
        if (link !== '#') {
            window.location.href = link; // Redireciona para o link de download
        } else {
            Swal.fire({
                title: 'Aviso',
                text: 'Nenhum comprovante disponível para download.',
                icon: 'warning',
                confirmButtonText: 'Ok'
            });
        }
    }
});


    </script>
</body>
</html>
