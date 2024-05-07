<?php
//=================\ INICIA A SESSÃO E LOGA NO BD /=================\\
session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

//=================\ DADOS DO USUÁRIO LOGADO /=================\\

// Consulta SQL para obter os dados do usuário
$sql = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION['id_usuario'];
$resultado = mysqli_query($conexao, $sql);

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Obtém os dados do usuário
$dados = mysqli_fetch_assoc($resultado);

//=================\ SELECIONA USUÁRIO NA LISTA /=================\\

if ($_GET) {

    $id_usuario_selecionado = $_GET['usuario_selecionado'];

    // Consulta SQL para obter as roupas do usuário selecionado
    $resultado_roupas_usuario = mysqli_query($conexao, "SELECT * FROM roupas WHERE id_usuario = $id_usuario_selecionado");

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado_roupas_usuario) {
        echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
        exit();
    }
}

//=================\ ATUALIZA A LISTA DE ITENS /=================\\

if ($_POST) {

    $id_usuario_selecionado = $_POST['id_usuario_selecionado'];
    $status_devolucao = $_POST['status_devolucao'];

    // Consulta SQL para obter as roupas do usuário selecionado
    $resultado_roupas_usuario = mysqli_query($conexao, "SELECT * FROM roupas WHERE id_usuario = $id_usuario_selecionado");

    // Atualiza o status de devolução das roupas do usuário
    while ($r = mysqli_fetch_assoc($resultado_roupas_usuario)) {
        if (empty($status_devolucao)) {
            mysqli_query($conexao, "UPDATE roupas SET status_devolucao = 0 WHERE id_usuario = $id_usuario_selecionado");
        } else {
            if (in_array($r['id'], $status_devolucao) and $r['status_devolucao'] == 0) {
                mysqli_query($conexao, "UPDATE roupas SET status_devolucao = 1 WHERE id_usuario = $id_usuario_selecionado AND id = " . $r['id']);
            }
            if (!in_array($r['id'], $status_devolucao) and $r['status_devolucao'] == 1) {
                mysqli_query($conexao, "UPDATE roupas SET status_devolucao = 0 WHERE id_usuario = $id_usuario_selecionado AND id = " . $r['id']);
            }
        }
    }

    // Obtém a lista atualizada para exibição na tela
    $sql_roupas_usuario = "SELECT * FROM roupas WHERE id_usuario = $id_usuario_selecionado";
    $resultado_roupas_usuario = mysqli_query($conexao, $sql_roupas_usuario);

    // Mostra um alerta SweetAlert2 em vez da mensagem de sucesso
    echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Status de devolução atualizado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/img/icon.png">
    <title>Sentinela da fronteira</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body>
    <!-- Navigation -->
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="##"></ion-icon>
                    </span>
                    <span class="title"> Sentinela da Fronteira </span>
                </a>
            </li>

            <li>
                <a href="../dashboard.php">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="form/index.php">
                    <span class="icon">
                        <ion-icon name="pencil-outline"></ion-icon>
                    </span>
                    <span class="title">Cadastro</span>
                </a>
            </li>

            <li>
                <a href="../perfil.php">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Perfil</span>
                </a>
            </li>

            <li>
                <a onclick="confirmLogout()">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sair</span>
                </a>
            </li>

        </ul>
    </div>

    <!-- Modal -->
    <div id="modal-container" class="modal-container">
        <div class="modal">
            <h1><?php echo $_SESSION['nome'] ?></h1>
            <p> Você realmente deseja sair?</p>
            <button onclick="confirmLogout()">Sair</button>
            <button onclick="cancelLogout()">Cancelar</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <div class="user">
            <img src="../../img/<?php echo $dados['imagem'] ?>" alt="">
        </div>

        <section class="py-5">
            <div class="container">
                <div class="nome">
                    <br>
                    <br>
                    <br>
                    <h1 class="fw-light">Bem-vindo(a)</h1>
                    <p class="lead">
                        <?php echo $_SESSION['nome'] ?>

                    </p>
                </div>
            </div>
        </section>


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
                    <tbody>
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
                <button type="submit" class="btn btn-primary btn-sm">Salvar Status</button>
            </form>
        <?php endif; ?>

        <script src="../../JavaScript/main.js"></script>
        <script src="../../JavaScript/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            function confirmLogout() {
                Swal.fire({
                    title: '<?php echo $_SESSION['nome'] ?>',
                    text: "Você realmente deseja sair?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, sair',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../logout.php';
                    }
                });
            }

            function cancelLogout() {
                Swal.fire({
                    title: 'Operação cancelada',
                    text: 'Você permanecerá na página atual',
                    icon: 'info',
                    confirmButtonText: 'OK' 
                });
            }
        </script>

        <!-- ionicons -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>