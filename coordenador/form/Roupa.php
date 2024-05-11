<?php
session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário e realiza a validação básica
    $id_usuario = isset($_POST['usuario_selecionado']) ? mysqli_real_escape_string($conexao, $_POST['usuario_selecionado']) : null;
    $nome_roupa = isset($_POST['nome_roupa']) ? mysqli_real_escape_string($conexao, $_POST['nome_roupa']) : null;
    $status_roupa = isset($_POST['status_roupa']) ? mysqli_real_escape_string($conexao, $_POST['status_roupa']) : null;

    if (!$id_usuario || !$nome_roupa || !$status_roupa) {
        // Se algum campo estiver vazio, exibe uma mensagem de erro
        echo "<p>Erro: Por favor, preencha todos os campos.</p>";
        exit();
    }

    // Verifica se a roupa já está cadastrada para o usuário selecionado
    $sql_verificar_roupa = "SELECT id_roupa FROM roupas WHERE id_usuario = '$id_usuario' AND nome = '$nome_roupa'";
    $resultado_verificar_roupa = mysqli_query($conexao, $sql_verificar_roupa);

    // Verifica se a consulta foi bem-sucedida
    if ($resultado_verificar_roupa && mysqli_num_rows($resultado_verificar_roupa) > 0) {
        // Se a roupa já estiver cadastrada, exibe uma mensagem ao administrador
        echo "<p>Atenção: Esta roupa já está cadastrada para o usuário selecionado.</p>";
        exit();
    }

    // Insere a nova roupa na tabela roupas
    $sql_insert_roupa = "INSERT INTO roupas (id_usuario, nome, status_devolucao) VALUES ('$id_usuario', '$nome_roupa', '$status_roupa')";
    $resultado_insert_roupa = mysqli_query($conexao, $sql_insert_roupa);

   // Verifica se a inserção foi bem-sucedida
   if ($resultado_insert_roupa) {
    echo "<p>Sucesso: A roupa foi cadastrada com sucesso.</p>";
    exit();
} else {
    // Se houver algum erro, exibe uma mensagem de erro
    echo "<p>Erro ao cadastrar a roupa: " . mysqli_error($conexao) . "</p>";
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="formulario/img/cadastro.png">
    <link rel="stylesheet" type="text/css" href="formulario/css/reset.css">
    <link rel="stylesheet" type="text/css" href="formulario/css/style.css">
    <title>Cadastro</title>
</head>
<body>
    <header class="main_header container">
        <div class="content">
            <div class="main_header_logo">
                <img src="../form/formulario/img/logo.jpg" alt="logo.jpg" />
            </div>
        </div>
    </header>
    <main class="main_content container">
        <section class="section-seu-codigo container">
            <div class="content">
                <div class="box-artigo">
                    <!--Inícia Formulário-->
                    <div class="container_form">
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

                            <button type="submit" class="submit_btn">Enviar</button>
                            <a href="../form/index.php" class="submit_btn">VOLTAR</a>

                        </form>

                    </div><!-- container_form -->
                </div><!-- Box Artigo -->
                <div class="clear"></div>
        </section><!-- FECHA BOX HTML -->
    </main>
</body>
</html>
