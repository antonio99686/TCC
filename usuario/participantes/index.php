<?php
session_start(); 
require_once "../conexao.php";
$conexao = conectar(); 

// Verifica se a sessão está iniciada e se o usuário está logado
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit(); // Termina a execução do script após o redirecionamento
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário baseado no ID
$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
$resultado = mysqli_query($conexao, $sql); // Executa a consulta SQL

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    // Exibe um erro se houve um problema na consulta
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit(); // Termina a execução do script
}

// Obtém os dados do usuário a partir do resultado da consulta
$dados = mysqli_fetch_assoc($resultado); // Armazena os dados do usuário em um array associativo

// Função para calcular a idade com base na data de nascimento
function calcular_idade($data_nascimento) {
    $data_nasc = new DateTime($data_nascimento); // Cria um objeto DateTime com a data de nascimento
    $hoje = new DateTime(); // Obtém a data atual
    $idade = $hoje->diff($data_nasc); // Calcula a diferença entre a data atual e a data de nascimento
    return $idade->y; // Retorna a idade em anos
}

// Função para determinar a categoria com base na idade
function determinar_categoria($idade) {
    // Define as categorias com base na idade
    if ($idade <= 12) {
        return 'Mirim'; // Categoria para crianças até 12 anos
    } elseif ($idade <= 17) {
        return 'Juvenil'; // Categoria para adolescentes de 13 a 17 anos
    } else {
        return 'Adulto'; // Categoria para adultos acima de 17 anos
    }
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
                <h2>Unindo Forças é <span class="danger">Bem Mais Fácil</span></h2>
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
                    <h3>Calendário</h3>
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

                <a href="logout.php">
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
                // Consulta SQL para buscar os dados dos dançarinos com base na categoria
                $sql = "SELECT * FROM usuario WHERE statuss = 1";
                $resultado = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($resultado) > 0) {
                    // Exibindo os resultados em uma tabela
                    echo ' <div class="formato"><table class="table table-striped">
    <thead class="thead-info">
        <tr>
               
                   <th>Nome</th>
                   <th>Data de Nascimento</th>
                   <th>Categoria</th>
                   <th>Usuário</th> 
                   </tr>
                   </thead>
                   <tbody>';
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $idade = calcular_idade($row['datas']);
                        $categoria = determinar_categoria($idade);
                        echo '<tr>';
                        $data = date("d/m/Y", strtotime($row['datas']));
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $data . "</td>";
                        echo "<td>" . $categoria . "</td>";
                        echo "<td><div class='users'><img src='../../img/perfil/" . $row['imagem'] . "' ></div></td>";
                        echo "<td>
                    
                </td>";
                        echo '</tr>';
                    }
                } else {
                    echo 'Nenhum resultado encontrado.';
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
                    <span class="material-icons-sharp ">
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
                        <img src="../../img/perfil/<?php echo $dados['imagem'] ?>" alt="user">
                    </div>
                </div>

            </div>
            <!-- Fim da navegação -->

        </div>

    </div>

    <script src="../JavaScript/index.js"></script>
   
</body>

</html>
