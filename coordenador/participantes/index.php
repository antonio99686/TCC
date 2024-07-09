<?php
session_start();
require_once "../../conexao.php";
$conexao = conectar();

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

// Aguarda 1 segundo antes de redirecionar o usuário
sleep(1);
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

    <title>Sentinela da Fronteira</title>
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
                <a href="../calen" target="_blank">
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
            <!-- Análises -->

            <div class="analyse">
                <div class="sales">
                    <a href="../form/formcad.php">
                        <div class="status">
                            <div class="info">
                                <h3>Cadastro</h3>
                                <h1>Cadastre o Usuário</h1>
                            </div>
                            <div class="progresss">

                            </div>
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
                            <div class="progresss">

                            </div>
                        </div>
                    </a>
                </div>



                <div class="searches">
                    <a href="../form/roupa.php">
                        <div class="status">
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

                <form method="POST">
                    <label>Selecione a Nivel</label>
                    <select class="form-control" name="categoria" onchange="this.form.submit()">
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
                       <th>PDF</th>
                       
                   

                       </tr>
                    </thead>
                    <tbody>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            $data_entrada = date("d/m/Y", strtotime($row['data_entrada']));
                            echo "<td>" . $row['id_usuario'] . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['CPF'] . "</td>";
                            echo "<td>" . $data_entrada . "</td>";
                            echo "<td>" . $row['matricula'] . "</td>";
                            echo "<td>
                                    <a href='../../PDF/index.php?id_usuario=" . $row['id_usuario'] .
                                "&nome=" . $row['nome'] .
                                "&email=" . $row['email'] .
                                "&CPF=" . $row['CPF'] .
                                "&data_entrada=" . $data_entrada .
                                "&mattricula=" . $row['matricula'] . "'>
                                    <img src='img/pdf.png' width='25' height='20' alt='PDF'>
                                    </a>
                                    </td> <td>
                                   
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
                    <img class="imgs" src="../../img/fundo.png">
                    <h2>Sentinela da Fronteira</h2>

                </div>
            </div>



        </div>


    </div>


    <script src="../JavaScript/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirecionar para formExcluir.php com o id_usuario
                        window.location.href = `formExcluir.php?id_usuario=${userId}`;
                    }
                });
            });
        });
    </script>
</body>

</html>