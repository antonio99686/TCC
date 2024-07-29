<?php
session_start();
require_once "../../conexao.php";
$conexao = conectar();
sleep(1);

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id_usuario']);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$dados = mysqli_fetch_assoc($resultado);

if (isset($_GET['nome_usuario'])) {
    $nome_usuario = $_GET['nome_usuario'];
    $stmt = mysqli_prepare($conexao, "SELECT id_usuario, nome FROM usuario WHERE nome LIKE CONCAT('%', ?, '%') AND statuss = 1 ORDER BY nome ASC");
    mysqli_stmt_bind_param($stmt, "s", $nome_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $usuarios = [];
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($usuario = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $usuario;
        }
    }

    echo json_encode($usuarios);
    exit();
}

if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
    $stmt = mysqli_prepare($conexao, "SELECT id, mes, pagamento FROM mensalidades WHERE usuario_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    if (mysqli_stmt_execute($stmt)) {
        $resultado = mysqli_stmt_get_result($stmt);
        $mensalidades = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        echo json_encode($mensalidades);
    } else {
        echo json_encode(["error" => "Erro ao executar a consulta: " . mysqli_error($conexao)]);
    }
    exit();
}

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
    <link rel="stylesheet" href="css/pag.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Sentinela da fronteira</title>
</head>
<body>
    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Unindo Forças é <span class="danger">Bem Mais Facíl </span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="../dashboard.php">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="../participantes">
                    <span class="material-icons-sharp">groups</span>
                    <h3>Users</h3>
                </a>
                <a href="../perfil.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Perfil</h3>
                </a>
                <a href="../calen">
                    <span class="material-icons-sharp">event</span>
                    <h3>Calendario</h3>
                </a>
                <a href="../pagamentos">
                    <span class="material-icons-sharp">paid</span>
                    <h3>Pagamento</h3>
                </a>
                <a href="../acessorios" class="active">
                    <span class="material-icons-sharp">checkroom</span>
                    <h3>Vestimentas</h3>
                </a>
                <a href="../../email">
                    <span class="material-icons-sharp">email</span>
                    <h3>Email</h3>
                </a>
                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
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
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
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
            <div class="reminder">
                <input type="text" id="nome_usuario" onkeyup="buscarUsuarios()" placeholder="Digite o nome do usuário...">
                <div id="resultados_busca"></div>
            </div>
        </div>
    </div>
    <script>
        function buscarUsuarios() {
            var nome_usuario = document.getElementById('nome_usuario').value;

            if (nome_usuario.trim() === '') {
                document.getElementById('resultados_busca').innerHTML = '';
                return;
            }

            fetch(`?nome_usuario=${nome_usuario}`)
                .then(response => response.json())
                .then(usuarios => {
                    var resultadosBusca = document.getElementById('resultados_busca');
                    resultadosBusca.innerHTML = '';

                    if (usuarios.length === 0) {
                        resultadosBusca.innerHTML = '<p>Nenhum usuário encontrado.</p>';
                    } else {
                        usuarios.forEach(usuario => {
                            var div = document.createElement('div');
                            div.className = 'usuario';
                            div.textContent = usuario.nome;
                            div.addEventListener('click', () => {
                                buscarMensalidades(usuario.id_usuario);
                            });
                            resultadosBusca.appendChild(div);
                        });
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Ocorreu um erro ao buscar usuários.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                });
        }

        function buscarMensalidades(id_usuario) {
            fetch(`?id_usuario=${id_usuario}`)
                .then(response => response.json())
                .then(mensalidades => {
                    var resultadosBusca = document.getElementById('resultados_busca');
                    resultadosBusca.innerHTML = '';

                    if (mensalidades.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: mensalidades.error,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                    } else if (mensalidades.length === 0) {
                        resultadosBusca.innerHTML = '<p>Nenhuma mensalidade encontrada.</p>';
                    } else {
                        mensalidades.forEach(mensalidade => {
                            var div = document.createElement('div');
                            div.className = 'mensalidade';
                            div.textContent = `Mês: ${mensalidade.mes}, Pagamento: ${mensalidade.pagamento}`;
                            resultadosBusca.appendChild(div);
                        });
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Ocorreu um erro ao buscar mensalidades.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script>
</body>
</html>
