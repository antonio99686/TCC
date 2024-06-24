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

// Consulta SQL para obter a lista de usuários ativos
$sql_usuarios = "SELECT id_usuario, nome FROM usuario WHERE statuss = 1";
$resultado_usuarios = mysqli_query($conexao, $sql_usuarios);

// Verifica se a consulta foi bem-sucedida
if (!$resultado_usuarios) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário e realiza a validação básica
    $id_usuario = isset($_POST['usuario_selecionado']) ? intval($_POST['usuario_selecionado']) : null;
    $nome_roupa = isset($_POST['nome_roupa']) ? htmlspecialchars($_POST['nome_roupa']) : null;
    $status_roupa = isset($_POST['status_roupa']) ? htmlspecialchars($_POST['status_roupa']) : null;

    if (!$id_usuario || !$nome_roupa || !$status_roupa) {
        // Se algum campo estiver vazio, exibe uma mensagem de erro
        echo "<p>Erro: Por favor, preencha todos os campos.</p>";
        exit();
    }

    // Preparar e executar a consulta para inserir a nova roupa na tabela roupas
    $sql_insert_roupa = "INSERT INTO roupas (id_usuario, nome, status_devolucao) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql_insert_roupa);
    mysqli_stmt_bind_param($stmt, "iss", $id_usuario, $nome_roupa, $status_roupa);
    $resultado_insert_roupa = mysqli_stmt_execute($stmt);

    // Verifica se a inserção foi bem-sucedida
    if ($resultado_insert_roupa) {
        echo "<script>alert('Sucesso: A roupa foi cadastrada com sucesso.');";
        echo "window.location.href = 'roupa.php';</script>";
        exit();
    } else {
        // Se houver algum erro, exibe uma mensagem de erro
        echo "<script>alert('Erro ao cadastrar a roupa.');";
        echo "window.location.href = 'roupa.php';</script>";
        exit();
    }
}

// Consulta SQL para obter a lista de usuários ativos
$sql_usuarios = "SELECT id_usuario, nome FROM usuario WHERE statuss = 1";
$resultado_usuarios = mysqli_query($conexao, $sql_usuarios);

// Verifica se a consulta foi bem-sucedida
if (!$resultado_usuarios) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}
// Aguarda 1 segundos antes de redirecionar o usuário
sleep(1);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulário de Inscrição</title>
    <link rel="stylesheet" href="formulario/css/style.css" />
    <link rel="shortcut icon" href="formulario/img/cadastro.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container">
        <header>
            <img src="img/icno.jpg" alt="Logo" class="logo" />
        </header>
        <h1> Cadastro da Roupa do Usuário </h1>
        <form method="POST" action="Roupa.php">
            <label for="nome_roupa">Nome da Roupa:</label>
            <input type="text" id="nome_roupa" name="nome_roupa" required>

            <label for="usuario_selecionado">Selecione o usuário:</label>
            <select id="usuario_selecionado" name="usuario_selecionado" required>
                <?php
                // Exibe as opções de usuários
                while ($row = mysqli_fetch_assoc($resultado_usuarios)) {
                    echo "<option value='" . $row['id_usuario'] . "'>" . $row['nome'] . "</option>";
                }
                ?>
            </select>

            <label for="status_roupa">Status da Roupa:</label>
            <select id="status_roupa" name="status_roupa" required>
                <option value="Pendente">Pendente</option>
                <option value="Entregue">Entregue</option>
            </select>

            <button type="submit" name="Submit" class="form-control">Cadastrar</button>
            <a href="../dashboard.php" class="form-control">Voltar</>

        </form>
</body>

</html>