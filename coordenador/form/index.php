<?php
session_start();
include ("../conexao.php");

// Verifica se o usuário está logado
if (isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário
$sql = "SELECT * FROM usuario WHERE id_usuario " . $_SESSION['id_usuario'];
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
    <link rel="shortcut icon" href="../img/img/icon.png">
    <title>Sentinela da fronteira</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../../css/janela.css">
    <link rel="stylesheet" href="formulario/css/index.css">


</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
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
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </span>
                        <span class="title">Cadastrar</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">Calendario</span>
                    </a>
                </li>

                <span class="icon">
                    <div onclick="openModal()" class="btn"> <ion-icon name="log-out-outline"></ion-icon></div>
                </span>
            </ul>
        </div>

        <!-- ========================= Principal ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

            <div id="modal-container" class="modal-container">
        <div class="modal">
            <button class="fechar" id="fechar">X</button>
            <h1><?php echo $_SESSION['nome'] ?></h1>
            <p> Você é realmente deseja sair</p>
            <p> <a href="../logout.php"><img src="../../img/img/correto.png" height="40px" width="40px"> </a></p> 
            <p> <a href="dashboard.php"><img src="../../img/img/cruz.png" height="40px" width="40px"> </a></p>

        </div>
    </div>
            <!-- Conteúdo da página -->
            <section class="py-5">
                <div class="containerrr">
                    <br>
                    <br>
                    <br>
                    <h1 class="fw-light">Bem-vindo(a), ao menu de Cadastrar</h1>
                    <p class="lead">
                        <?php echo $_SESSION['nome'] ?>
                    </p>
                    <img src="../../img/<?php echo $_SESSION['imagem'] ?>" height="150px" width="150px">
                </div>
            </section>

            <div class="card_meio">
                <div class="card verde">
                    <a href="../form/formCad.php">
                        <h2>Cadastro</h2>
                        <p>Cadastre o Usuário </p>
                    </a>
                </div>
                <div class="card azul">
                    <a href="../form/lista.php">
                        <h2>Editar</h2>
                        <p>Edite o Usuário</p>
                    </a>
                </div>
                <div class="card vermelho">
                    <a href="../form/formExcluir.php">
                        <h2>Excluir</h2>
                        <p>Exclui o Usuário</p>
                    </a>
                </div>
                

            </div>



            <footer class="footer">
     <div class="containeres">
      <div class="row">
        <div class="footer-col">
          <h4>Telefone</h4>
          <ul>
          <li><a href="#">(55) 000000000</a></li>
          <li><a href="#">(55) 0000-0000</a></li>
           
          </ul>
        </div>
        <div class="footer-col">
          <h4>E-mail</h4>
          <ul>
            <li><a href="#">SentineladaFronteira@gmail.com</a></li>
            
          </ul>
        </div>
       
        <div class="footer-col">
          <h4>Siga-nos</h4>
          <div class="social-links">
          <a href="https://www.facebook.com/pages/Piquete%20Sentinela%20Da%20Fronteira/843171032373964/photos/?locale=pt_BR"> 
          <ion-icon name="logo-facebook"></ion-icon></a>
                <a href="https://www.instagram.com/ptgsentinelaoficial/" >
                <ion-icon name="logo-instagram"></ion-icon></a>
            
          </div>
        </div>
      </div>
     </div>
  </footer>
         


            <!-- =========== Scripts =========  -->
            <script src="../../java/main.js"></script>
            <script src="../../java/script.js"></script>

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>