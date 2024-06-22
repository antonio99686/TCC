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

// Aguarda 1 segundos antes de redirecionar o usuário
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
    <link rel="stylesheet" href="formulario/css/style2.css">
    
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
            <h1>Sentinela da Fronteira</h1>
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
                 <a href="../form/lista.php" class="active" >   <div class="status">
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
                            <h1>Cadasto da Roupa do  Usuário</h1>
                        </div>
                        <div class="progresss">
                           
                        </div>
                    </div>
                </div> </a>
               
            </div>
            <!-- Fim  -->


            <!-- Fim -->

            <!-- Tabela  -->
            <div class="box">
            <form method="POST">
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
        if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {

            // Evitar SQL injection
            $status = $conexao->real_escape_string($_POST['categoria']);

            // Consulta SQL para buscar os dados da selecionada
            $sql = "SELECT * FROM usuario WHERE statuss = '$status'";
            $result = $conexao->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    // Exibindo os resultados em uma tabela
                    echo ' <div class="formato"><table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Matrícula</th>
                            <th>CPF</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>';
                  
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo "<td>" . $row['id_usuario'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['matricula'] . "</td>";
                        echo "<td>" . $row['CPF'] . "</td>";
                                       
                        echo "<td>
                                <a href='formEdit.php?id_usuario=" . $row['id_usuario'] . 
                                    "&nome=" . $row['nome'] . 
                                    "&email=" . $row['email'] . 
                                    "&CPF=" . $row['CPF'] . 
                                    "&senha=" . $row['senha'] . 
                                    "&datas=" . $row['datas'] . 
                                    "&statuss=" . $row['statuss'] . 
                                    "&RG=" . $row['RG'] . 
                                    "&categoria=" . $row['categoria'] . 
                                    "&telefone=" . $row['telefone'] . 
                                    "&endereco=" . $row['endereco'] . 
                                    "&responsavel=" . $row['responsavel'] . 
                                    "&data_entrada=" . $row['data_entrada'] . 
                                    "&tele_respon=" . $row['tele_respon'] . 
                                    "&idade=" . $row['idade'] . 
                                    "&nom_dan=" . $row['nom_dan'] . 
                                    "&genero=" . $row['genero'] . 
                                    "&imagem=" . $row['imagem'] . "'>
                                    <span class='material-icons-sharp'>
                                    edit
                                </span></td>
                                </a>
                                <td><a href='formExcluir.php?id_usuario=" . $row['id_usuario'] . "' onclick='return confirmDelete(" . $row['id_usuario'] . ")'>
                                <span class='material-icons-sharp'>
                                delete
                            </span>
                                </a></td>
                              ";
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

            </div>
            <!-- Fim -->

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

    <script src="../JavaScript/orders.js"></script>
    <script src="../JavaScript/index.js"></script>
</body>

</html>