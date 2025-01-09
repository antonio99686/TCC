<?php
session_start(); 
require_once "../../conexao.php"; 
$conexao = conectar();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit(); 
}

// Obtém os dados do usuário logado
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql); 
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id_usuario']); 
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt); 
$dados = mysqli_fetch_assoc($resultado);

// Verifica se foi feita uma requisição de busca de usuários
if (isset($_GET['nome_usuario'])) {
    $nome_usuario = $_GET['nome_usuario']; 
    // Prepara a consulta SQL para buscar usuários com base no nome
    $stmt = mysqli_prepare($conexao, "SELECT id_usuario, nome FROM usuario WHERE nome LIKE CONCAT('%', ?, '%') AND statuss = 1 ORDER BY nome ASC");
    mysqli_stmt_bind_param($stmt, "s", $nome_usuario); // Associa o parâmetro à consulta de busca
    mysqli_stmt_execute($stmt); // Executa a consulta preparada
    $resultado = mysqli_stmt_get_result($stmt); // Obtém o resultado da consulta

    $usuarios = []; // Inicializa um array para armazenar os usuários encontrados
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($usuario = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $usuario; // Armazena os usuários encontrados no array $usuarios
        }
    }

    echo json_encode($usuarios); // Retorna os usuários encontrados como JSON e termina o script
    exit(); // Encerra a execução após retornar a resposta
}

// Verifica se um usuário foi selecionado
if (isset($_GET['usuario_selecionado'])) {
    $id_usuario_selecionado = $_GET['usuario_selecionado']; // Obtém o ID do usuário selecionado

    // Consulta SQL para obter as roupas do usuário selecionado
    $stmt = mysqli_prepare($conexao, "SELECT * FROM roupas WHERE id_usuario = ?"); // Prepara a consulta para buscar roupas
    mysqli_stmt_bind_param($stmt, "i", $id_usuario_selecionado); // Associa o parâmetro à consulta de roupas
    mysqli_stmt_execute($stmt); // Executa a consulta preparada
    $resultado_roupas_usuario = mysqli_stmt_get_result($stmt); // Obtém o resultado da consulta de roupas

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado_roupas_usuario) {
        echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao); // Exibe erro em caso de falha na consulta
        exit(); // Encerra a execução em caso de erro
    }
}

// Inicializa a variável para mensagem do SweetAlert
$sweetalert_msg = ""; 

// Atualiza a lista de itens se o formulário for enviado
if ($_POST) { // Verifica se o formulário foi submetido
    $id_usuario_selecionado = $_POST['id_usuario_selecionado']; // Obtém o ID do usuário selecionado do formulário
    // Obtém os status de devolução enviados no formulário
    $status_devolucao = isset($_POST['status_devolucao']) ? $_POST['status_devolucao'] : []; 

    // Consulta SQL para obter as roupas do usuário selecionado
    $resultado_roupas_usuario = mysqli_query($conexao, "SELECT * FROM roupas WHERE id_usuario = $id_usuario_selecionado");

    $status_atualizado = false; // Inicializa a variável para verificar se o status foi atualizado

    // Atualiza o status de devolução das roupas do usuário
    while ($r = mysqli_fetch_assoc($resultado_roupas_usuario)) {
        $novo_status = in_array($r['id'], $status_devolucao) ? 1 : 0; // Define o novo status com base na seleção do formulário
        if ($novo_status != $r['status_devolucao']) { // Verifica se o status foi alterado
            // Atualiza o status de devolução no banco de dados
            mysqli_query($conexao, "UPDATE roupas SET status_devolucao = $novo_status WHERE id_usuario = $id_usuario_selecionado AND id = " . $r['id']);
            $status_atualizado = true; // Marca que o status foi atualizado
        }
    }

    // Obtém a lista atualizada para exibição na tela
    $sql_roupas_usuario = "SELECT * FROM roupas WHERE id_usuario = $id_usuario_selecionado";
    $resultado_roupas_usuario = mysqli_query($conexao, $sql_roupas_usuario);

    // Define a mensagem de sucesso para o SweetAlert se o status foi atualizado
    if ($status_atualizado) {
        $sweetalert_msg = "Status de devolução atualizado com sucesso!"; // Mensagem de sucesso
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../../img/img/admin.png">
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
                    <h3>Usuário</h3>
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
            <h1>Vestimentas</h1>
            <!-- Análises -->
            <div class="analyse">
                <div class="sales">
                    <a href="../form/formcad.php">
                        <div class="status">
                            <div class="info">
                                <h3>Cadastro</h3>
                                <h1>Cadastre o Usuário</h1>
                            </div>
                            <div class="progresss"></div>
                        </div>
                    </a>
                </div>
                <div class="visits">
                    <a href="../form/lista.php">
                        <div class="status">
                            <div class="info">
                                <h3>Editar</h3>
                                <h1>Edite o Usuário</h1>
                            </div>
                            <div class="progresss"></div>
                        </div>
                    </a>
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

                <?php if (isset($resultado_roupas_usuario)): ?>
                    <!-- Exibição de Roupas do Usuário Selecionado -->
                    <h2>Roupas do Usuário Selecionado</h2>
                    <form method="post" action="">
                        <input type="hidden" name="id_usuario_selecionado" value="<?php echo $id_usuario_selecionado; ?>">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Roupa</th>
                                    <th>Status</th> <!-- Adicionando cabeçalho para o status de devolução -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($resultado_roupas_usuario)): ?>
                                    <tr>
                                        <td><?php echo $row['nome']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['status_devolucao'] == 0)
                                                echo '<input class="form-check-input" type="checkbox" name="status_devolucao[]" value="' . $row['id'] . '"> <label class="form-check-label"> Pendente </label>';
                                            else
                                                echo '<input class="form-check-input" type="checkbox" name="status_devolucao[]" value="' . $row['id'] . '" checked> <label class="form-check-label"> Devolvido </label>';
                                            ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="button">Salvar</button>
                    </form>
                <?php endif; ?>
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

            
        </div>
    </div>
    <script src="../JavaScript/index.js"></script>
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
                        // Cria um link que redireciona para a seleção do usuário baseado no ID
                        output += `<li><a href="?usuario_selecionado=${usuario.id_usuario}">${usuario.nome}</a></li>`;
                    });
                    output += '</ul>'; // Fecha a lista de resultados
                    document.getElementById('resultados_busca').innerHTML = output; // Insere os resultados na div 'resultados_busca' do HTML
                }
            };
            xhr.send(); // Envia a requisição para o servidor
        } else {
            document.getElementById('resultados_busca').innerHTML = ''; // Limpa os resultados se o campo de busca estiver vazio
        }
    }
</script>

<?php if ($sweetalert_msg): ?> <!-- Verifica se há uma mensagem de sucesso para exibir -->
    <script>
        function showAlert(message) { // Função para exibir um alerta usando SweetAlert
            Swal.fire({
                icon: 'success', // Define o ícone do alerta como sucesso
                title: 'Sucesso!', // Título do alerta
                text: message, // Mensagem do alerta
                showConfirmButton: false, // Esconde o botão de confirmação
                timer: 1500 // Define um tempo para o alerta se fechar automaticamente
            });
        }
        showAlert('<?php echo $sweetalert_msg; ?>'); // Chama a função showAlert passando a mensagem do PHP
    </script>
<?php endif; ?> <!-- Fim da verificação da mensagem de sucesso -->
