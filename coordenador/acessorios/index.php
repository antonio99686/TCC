<?php
session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

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

// Consulta SQL para obter a lista de usuários com status 1
$sql_usuarios = "SELECT id_usuario, nome FROM usuario WHERE statuss = 1";
$resultado_usuarios = mysqli_query($conexao, $sql_usuarios);

// Verifica se a consulta foi bem-sucedida
if (!$resultado_usuarios) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuario_selecionado'])) {
    $id_usuario_selecionado = $_POST['usuario_selecionado'];

    // Consulta SQL para obter as roupas do usuário selecionado
    $sql_roupas_usuario = "SELECT * FROM roupas WHERE id_usuario = $id_usuario_selecionado";
    $resultado_roupas_usuario = mysqli_query($conexao, $sql_roupas_usuario);

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado_roupas_usuario) {
        echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
        exit();
    }
}

// Verifica se o formulário para atualização de status de devolução foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usuario']) && isset($_POST['status_devolucao'])) {
    $id_usuario = $_POST['id_usuario'];
    $status_devolucao = $_POST['status_devolucao'];

    // Atualiza o status de devolução das roupas do usuário
    $sql_update_status = "UPDATE roupas SET status_devolucao = '$status_devolucao' WHERE id_usuario = $id_usuario";
    $resultado_update = mysqli_query($conexao, $sql_update_status);

    if ($resultado_update) {
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
    } else {
        echo "Erro ao atualizar o status de devolução: " . mysqli_error($conexao);
    }
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


        <form method="post" action="">
        <div class="form-group">
            <label for="usuario_selecionado">Selecione o usuário:</label>
            <select class="form-control" id="usuario_selecionado" name="usuario_selecionado">
                <?php
                // Exibe as opções de usuários
                while ($row = mysqli_fetch_assoc($resultado_usuarios)) {
                    echo "<option value='" . $row['id_usuario'] . "'>" . $row['nome'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Selecionar</button>
    </form>

    <?php if (isset($resultado_roupas_usuario)): ?>
        <!-- Exibição de Roupas do Usuário Selecionado -->
        <h2>Roupas do Usuário Selecionado</h2>
        <form method="post" action="">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_selecionado; ?>">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Roupa</th>
                        <th>Status Devolução</th> <!-- Adicionando cabeçalho para o status de devolução -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($resultado_roupas_usuario)): ?>
                        <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td>
                                <select class="form-control" name="status_devolucao_<?php echo $row['id']; ?>">
                                    <option value="pendente">Pendente</option>
                                    <option value="entregue">Entregue</option>
                                </select>
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
