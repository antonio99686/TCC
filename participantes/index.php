<?php
session_start();
include ("conexao.php");

// Verifica se a sessão está iniciada e se o usuário está logado
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário utilizando prepared statements para evitar injeção de SQL
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- shortcut icon -->
    <link rel="shortcut icon" href="../img/img/icon.png">
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

                    <h2>## <span class="danger"> ## </span></h2>
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
                <a href="../participantes" class="active">
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
                <a href="../pagamento">
                    <span class="material-icons-sharp">
                        paid
                    </span>
                    <h3>Pagamento</h3>
                </a>
                <a href="../acessorios">
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
            <h1>Participantes</h1>

            <div class="recent-orders">
                <?php
                // Consulta SQL para buscar os dados da selecionada
                $sql = "SELECT * FROM usuario WHERE statuss = 1";
                $result = $conexao->query($sql);

                if ($result->num_rows > 0) {
                    // Exibindo os resultados em uma tabela
                    echo ' <div class="formato"><table class="table table-striped">
    <thead class="thead-info">
        <tr>
                   <th>ID</th>
                   <th>Nome</th>
                   <th>Data de Nascimento</th>
                   <th>Matricula</th>
                   <th>Usuário</th> 
                   </tr>
                   </thead>
                   <tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo "<td>" . $row['id_usuario'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['datas'] . "</td>";
                        echo "<td>" . $row['matricula'] . "</td>";
                        echo "<td><div class='users'><img src='../img/" . $row['imagem'] . "' ></div></td>";
                        echo "<td>
                    <a href='formedit.php?id_usuario=" .
                            $row['id_usuario'] .
                            "&nome=" . $row['nome'] .
                            "&data_entrada=" . $row['datas'] .
                            "&mattricula=" . $row['matricula'] . "'>
                        
                    </a>
                </td>";
                        echo '</tr>';
                    }


                } else {
                    echo 'Nenhum resultado encontrado para essa categoria.';
                }
                ?>

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
                        <p>Ola, <b>Bem-Vindo(a)</b></p>
                        <small class="text-muted"><?php echo $dados['nome'] ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="../img/<?php echo $dados['imagem'] ?>" alt="user">
                    </div>
                </div>

            </div>
            <!-- Fim da navegação -->





        </div>


    </div>

   
    <script src="../JavaScript/index.js"></script>
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
    <a onclick="confirmLogout()">
        <span class="icon">
            <ion-icon name="log-out-outline"></ion-icon>
        </span>

    </a>
</body>

</html>