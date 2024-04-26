<?php
session_start();
include ("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION)) {
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/img/icon.png">
    <title>Sentinela da fronteira</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
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
                <a href="../Dashboard.php">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="../form/index.php">
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

        <!-- Conteúdo da página -->
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

        <form method="POST">
        <label >Selecione a Nivel</label>
            <select class="form-control"  name="categoria" onchange="this.form.submit()">
            <option value="">Selecione</option>
                <option value="mirim">Mirim</option>
                <option value="juvenil">Juvenil</option>
                <option value="adulto">Adulto</option>
       
            </select>
        </form>
        <?php

// Verificar se a categoria foi enviada
if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {

    // Evitar SQL injection
    $categoria = $conexao->real_escape_string($_POST['categoria']);

    // Consulta SQL para buscar os dados da selecionada
    $sql = "SELECT * FROM usuario WHERE categoria = '$categoria'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        // Exibindo os resultados em uma tabela
        echo ' <div class="formato"><table class="table table-striped">
        <thead class="thead-info">
            <tr>
                       <th>ID</th>
                       <th>Nome</th>
                       <th>CPF</th>
                       <th>Data de Entrada</th>
                       <th>Matricula</th>

                       </tr>
                    </thead>
                    <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo "<td>" . $row['id_usuario'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['CPF'] . "</td>";
            echo "<td>" . $row['data_entrada'] . "</td>";
            echo "<td>" . $row['matricula'] . "</td>";
            echo "<td>
                        <a href='formedit.php?id_usuario=" . $row['id_usuario'] .
                "&nome=" . $row['nome'] .
                "&email=" . $row['email'] .
                "&CPF=" . $row['CPF'] .
                "&data_entrada=" . $row['data_entrada'] .
                "&mattricula=" . $row['matricula'] . "'>
                            
                        </a>
                        <a href='formExcluir.php?id_usuario=" . $row['id_usuario'] .
                "&nome=" . $row['nome'] .
                "&email=" . $row['email'] .
                "&CPF=" . $row['CPF'] . "'>
                         
                        </a>
                    </td>";
            echo '</tr>';
        }

        echo '
                </table>
            </div>';
    }
} else {
    echo 'Nenhum resultado encontrado para essa categoria.';
}

// Fechar conexão
$conexao->close();


?>

    <!-- Scripts -->
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
                    window.location.href = 'logout.php';
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