<?php
session_start(); // Inicia a sessão para permitir o uso de variáveis de sessão
require_once "../conexao.php"; // Inclui o arquivo de conexão com o banco de dados
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
                <a href="../email">
                    <span class="material-icons-sharp">email</span>
                    <h3>Email</h3>
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
                
            </div>
            <div class="box">
                <h2>Dados Usuário</h2>
                <div><em><b>Nome:</b></em> <?php echo htmlspecialchars($dados['nome']); ?></div>
                <div><em><b>Telefone:</b></em> <?php echo htmlspecialchars($dados['telefone']); ?></div>
                <div><em><b>E-mail:</b></em> <?php echo htmlspecialchars($dados['email']); ?></div>
                <div><em><b>CPF:</b></em> <?php echo htmlspecialchars($dados['CPF']); ?></div>
                <div><em><b>Idade:</b></em> <?php echo htmlspecialchars($dados['idade']); ?></div>
                <div><em><b>Matrícula:</b></em> <?php echo htmlspecialchars($dados['matricula']); ?></div>
                <div><em><b>Data de Nascimento:</b></em>
                    <?php echo htmlspecialchars(date('d/m/Y', strtotime($dados['datas']))); ?></div>
            </div>
        </main>
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp ">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Olá, <b>Bem-Vindo(a)</b></p>
                        <small class="text-muted"><?php echo htmlspecialchars($dados['nome']); ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="../img/perfil/<?php echo htmlspecialchars($dados['imagem']); ?>" alt="user">
                    </div>
                </div>
            </div>
            <div class="user-profile">
                <div class="logo">
                    <img class="imgs" src="../img/fundo.png">
                    <h2>Sentinela da Fronteira</h2>
                </div>
            </div>
            <div class="reminders">
                
                </div>
            </div>
        </div>
    </div>

    <!-- Campo de busca adicionado fora do modal -->


    <!-- Modal de Seleção de Usuário e Roupas -->
    <div id="userSelectionModal" class="modal">
        <div class="modal-content">
            <h1>Selecionar Usuário e Roupas</h1>
            <input type="text" class="form-control" id="nome_usuario" name="nome_usuario"
                placeholder="Digite o nome do usuário" onkeyup="buscarUsuarios()">
            <ul id="userList" class="user-list"></ul>
        </div>
    </div>

    <script src="JavaScript/index.js"></script>
    <script src="JavaScript/roupas.js"></script>
    <script>
        function buscarUsuarios() {
            const nomeUsuario = document.getElementById('nome_usuario').value; // Obtém o valor do campo de entrada de nome de usuário
            if (nomeUsuario.length > 0) { // Verifica se o campo não está vazio
                const xhr = new XMLHttpRequest(); // Cria um novo objeto XMLHttpRequest para fazer a requisição AJAX
                xhr.open('GET', `?nome_usuario=${nomeUsuario}`, true); // Configura a requisição GET para buscar usuários com base no nome digitado
                xhr.onload = function () { // Define o que fazer quando a requisição retornar
                    if (this.status === 200) { // Verifica se a requisição foi bem-sucedida
                        const resultados = JSON.parse(this.responseText); // Converte a resposta JSON em um objeto JavaScript
                        let output = '<ul>'; // Inicia uma lista não ordenada para mostrar os resultados
                        resultados.forEach(function (usuario) { // Itera sobre cada usuário retornado
                            output += `<li><a href="?usuario_selecionado=${usuario.id_usuario}">${usuario.nome}</a></li>`; // Cria um link para selecionar o usuário
                        });
                        output += '</ul>'; // Fecha a lista de resultados
                        document.getElementById('userList').innerHTML = output; // Insere os resultados na div 'resultados_busca' do HTML
                    }
                };
                xhr.send(); // Envia a requisição
            } else {
                document.getElementById('userList').innerHTML = ''; // Limpa os resultados se o campo de busca estiver vazio
            }
        }
    </script>

</body>

</html>