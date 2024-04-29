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
    <link rel="shortcut icon" href="../../img/img/icon.png">
    <title>Sentinela da fronteira</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="formulario/css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
                <a href="index.php">
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

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>

        <!-- USER -->
        <div class="user">
            <img src="../../img/<?php echo $dados['imagem'] ?>" alt="">
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
        <!-- Conteúdo da página -->
        <section class="py-5">
            <div class="containerrr">
                <br>
                <br>
                <br>
                <h1 class="fw-light">Edição</h1>
                <p class="lead">
                    <?php echo $dados['nome'] ?>
                </p>

            </div>
        </section>


        <form method="GET">
    <div class="form-group">
        <label for="categoria">Selecione a Categoria:</label>
        <select class="form-control" id="categoria" name="categoria" onchange="this.form.submit()">
            <option value="">Selecione...</option>
            <option value="1">Dançarino(a)</option>
            <option value="2">Coordenador</option>
            <option value="3">Responsável</option>
        </select>
    </div>
</form>

        <?php
        // Verificar se a categoria foi enviada
        if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {

            // Evitar SQL injection
            $status = $conexao->real_escape_string($_GET['categoria']);

            // Consulta SQL para buscar os dados da selecionada
            $sql = "SELECT * FROM usuario WHERE statuss = '$status'";
            $result = $conexao->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    // Exibindo os resultados em uma tabela
                    echo ' <div class="formato"><table class="table table-striped">
                    <thead class="thead-info">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo "<td>" . $row['id_usuario'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['CPF'] . "</td>";
                echo "<td>
                        <a href='codigo/formEdit.php?id_usuario=" . $row['id_usuario'] .
                                "&nome=" . $row['nome'] .
                                "&email=" . $row['email'] .
                                "&CPF=" . $row['CPF'] . "'>
                            <img src='formulario/img/lapis.png' width='20' height='20' alt='Editar'>
                        </a>
                        <a href='formExcluir.php?id_usuario=" . $row['id_usuario'] .
                                "&nome=" . $row['nome'] .
                                "&email=" . $row['email'] .
                                "&CPF=" . $row['CPF'] . "' onclick='return confirmDelete(event)'>
                            <img src='formulario/img/lixeira.png' width='20' height='20' alt='Excluir'>
                        </a>
                    </td>";
                echo '</tr>';
            }
            
            echo '</tbody>
                </table> </div>';
            
                } else {
                    echo 'Nenhum resultado encontrado para essa categoria.';
                }
            } else {
                // Exibir erro SQL se houver
                echo 'Erro na consulta: ' . $conexao->error;
            }

            // Fechar conexão
            $conexao->close();
        } else {
            echo 'Nenhum resultado encontrado para essa categoria.';
        }
        ?>
        <!-- =========== Scripts =========  -->
        <script src="../../JavaScript/main.js"></script>
        <script src="../../javascript/script.js"></script>
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

            function confirmDelete(event) {
                event.preventDefault(); // Impede o comportamento padrão do link
                Swal.fire({
                    title: 'Confirmar Exclusão',
                    text: 'Tem certeza que deseja excluir este item?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirecionar para o script de exclusão
                        window.location.href = event.target.href="formExcluir.php";
                    }
                });
                return false; // Impede o link de ser seguido imediatamente
            }

        </script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>