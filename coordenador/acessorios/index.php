<?php
// Inicia a sessão
session_start();
include ("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Consulta SQL para obter os dados do usuário usando instruções preparadas
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id_usuario']);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Obtém os dados do usuário
$dados = mysqli_fetch_assoc($resultado);

// Verifica se foi recebido um ID de usuário válido
if (isset($_GET['usuario_selecionado']) && is_numeric($_GET['usuario_selecionado'])) {
    $id_usuario_selecionado = $_GET['usuario_selecionado'];

    // Consulta SQL para obter as roupas do usuário selecionado usando instruções preparadas
    $sql_roupas_usuario = "SELECT * FROM roupas WHERE id_usuario = ?";
    $stmt_roupas_usuario = mysqli_prepare($conexao, $sql_roupas_usuario);
    mysqli_stmt_bind_param($stmt_roupas_usuario, "i", $id_usuario_selecionado);
    mysqli_stmt_execute($stmt_roupas_usuario);
    $resultado_roupas_usuario = mysqli_stmt_get_result($stmt_roupas_usuario);

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado_roupas_usuario) {
        echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
        exit();
    }
}

// Verifica se foi recebido dados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valida os dados recebidos por POST
    $id_usuario_selecionado = isset($_POST['id_usuario_selecionado']) ? $_POST['id_usuario_selecionado'] : null;
    $status_devolucao = isset($_POST['status_devolucao']) ? $_POST['status_devolucao'] : array();

    if (!is_numeric($id_usuario_selecionado)) {
        echo "ID de usuário inválido.";
        exit();
    }

    // Atualiza o status de devolução das roupas do usuário usando instruções preparadas
    $sql_update = "UPDATE roupas SET status_devolucao = ? WHERE id_usuario = ? AND id = ?";
    $stmt_update = mysqli_prepare($conexao, $sql_update);

    foreach ($status_devolucao as $id_roupa) {
        mysqli_stmt_bind_param($stmt_update, "iii", $novo_status, $id_usuario_selecionado, $id_roupa);
        $novo_status = in_array($id_roupa, $status_devolucao) ? 1 : 0;
        mysqli_stmt_execute($stmt_update);
    }

    // Mostra um alerta SweetAlert2 em vez da mensagem de sucesso
    echo "";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- shortcut icon -->
    <link rel="shortcut icon" href="../../img/img/icon.png">
    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
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
            <h1>Vestimentas</h1>
            <!-- Análises -->
           
             <div class="analyse">
               <div class="sales">
                     <a href="../form/formcad.php"><div class="status">
                        <div class="info">
                            <h3>Cadastro</h3>
                            <h1>Cadastre o Usuário</h1>
                        </div>
                        <div class="progresss">
                         
                        </div>
                    </div> </a>
                    
                </div> 
           

                
                    <div class="visits">
                 <a href="../form/lista.php">   <div class="status">
                        <div class="info">
                            <h3>Editar</h3>
                            <h1>Edite o Usuário</h1>
                        </div>
                        <div class="progresss">
                           
                        </div>
                    </div></a>
                </div>
                

                
                <div class="searches">
                    <a href="../form/roupa.php"><div class="status">
                        <div class="info">
                            <h3>Roupa</h3>
                            <h1>Cadasto da Roupa do Usuário</h1>
                        </div>
                        <div class="progresss">
                           
                        </div>
                    </div>
                </div> </a>
               
            </div>
            <!-- Fim das análises -->


            <!-- Fim da seção de novos usuários -->

            <!-- Tabela de pedidos recentes -->
            <div class="box">
                 <form method="GET" action="index.php">
            <div class="form-group">
                <label for="usuario_selecionado">Selecione o usuário:</label>
                <select class="form-control" id="usuario_selecionado" name="usuario_selecionado">
                    <?php

                    // Consulta SQL para obter a lista de usuários com status 1
                    $sql_usuarios = "SELECT id_usuario, nome FROM usuario WHERE statuss = 1";
                    $resultado_usuarios = mysqli_query($conexao, $sql_usuarios);

                    // Verifica se a consulta foi bem-sucedida
                    if (!$resultado_usuarios) {
                        echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
                        exit();
                    }

                    // Exibe as opções de usuários
                    while ($row = mysqli_fetch_assoc($resultado_usuarios)) {
                        if ($id_usuario_selecionado == $row['id_usuario'])
                            echo "<option value='" . $row['id_usuario'] . "' selected>" . $row['nome'] . "</option>";
                        else
                            echo "<option value='" . $row['id_usuario'] . "'>" . $row['nome'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Selecionar</button>
        </form>

        <?php if (isset($resultado_roupas_usuario)) : ?>
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
                    <tbody >
                 <?php while ($row = mysqli_fetch_assoc($resultado_roupas_usuario)) : ?>
                            <tr>
                                <td><?php echo $row['nome']; ?></td>
                                <td>
                                    <?php
                                    if ($row['status_devolucao'] == 0)
                                        echo '<input class="form-check-input" type="checkbox" name="status_devolucao[]" value="' . $row['id'] . '"> <label class="form-check-label"> Pendente </label>';
                                    else
                                        echo '<input class="form-check-input" class="form-control" type="checkbox" name="status_devolucao[]" value="' . $row['id'] . '" checked> <label class="form-check-label" for="flexCheckDefault"> Entregue </label>';
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn">Salvar Status</button>
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
            <!-- Fim da navegação -->

            <div class="user-profile">
                <div class="logo">
                    <img class="imgs" src="../../img/icno.jpg">
                    <h2>Sentinela da Fronteira</h2>

                </div>
            </div>



        </div>


    </div>

    <script src="../JavaScript/orders.js"></script>
    <script src="../JavaScript/index.js"></script>
</body>

</html>