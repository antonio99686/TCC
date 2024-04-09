  <?php

session_start();
include("conexao.php");

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
    <link rel="shortcut icon" href="img/img/icon.png">
    <title>Sentinela da fronteira</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="css/janela.css">
    <link rel="stylesheet" href="css/dashbord.css">

   
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
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

        

                <li>
                    <a href="calen/index.php">
                        <span class="icon">
                        <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">Calendario</span>
                    </a>
                </li>

                .modal {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Adiciona sombra */
}
              
                    <span class="icon">
                    <div onclick="openModal()" class="btn"> <ion-icon name="log-out-outline"></ion-icon></div>
                    </span>
            
            </ul>
        </div>

        <div id="modal-container" class="modal-container">
        <div class="modal">
            <button class="fechar" id="fechar">X</button>
            <h1><?php echo $_SESSION['nome'] ?></h1>
            <p> Você é realmente deseja sair</p>
            <p> <a href="logout.php"><img src="img/img/correto.png" height="40px" width="40px"> </a></p> 
            <p> <a href="dashboard.php"><img src="img/img/cruz.png" height="40px" width="40px"> </a></p>

        </div>
    </div>

        <!-- ========================= Principal ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                
                
            </div>

           <!-- Conteúdo da página -->
    <section class="py-5">
        <div class="containerrr">
            <br>
            <br>
            <br>
            <h1 class="fw-light">Bem-vindo(a)</h1>
            <p class="lead">
                <?php echo $_SESSION['nome'] ?>
            </p>
            <img src="img/<?php echo $_SESSION['imagem']?>" height="150px" width="150px" >
        </div>
    </section>

        <div class="infor"> <?php
        echo "Nome: " . $_SESSION['nome'] . "<br>";
        echo "E-mail: " . $_SESSION['email'] . "<br>";
        echo "Matrícula: " . $_SESSION['usuario'] . "<br>";
        echo "CPF: " . $_SESSION['CPF'] . "<br>";
        echo "RG: " . $_SESSION['RG'] . "<br>";
        echo "Data de Nascimento: " . $_SESSION['datas'] . "<br>";
        echo "Endereço: " . $_SESSION['endereco'] . "<br>";
        echo "Responsável: " . $_SESSION['responsavel'] . "<br>";
        echo "Data de Entrada: " . $_SESSION['data_entrada'] . "<br>";
        echo "Telefone Responsável: " . $_SESSION['tele_respon'] . "<br>";
        ?>
    </div>

    <div class="cardss">
        <section class="hero-section">
            <div class="card-grid">
                <a class="card" href="pagamento">
                    <div class="card__background"
                        style="background-image: url(https://www.gruporecovery.com/wp-content/uploads/2023/09/MicrosoftTeams-image-1.png)">
                    </div>
                    <div class="card__content">
                        <p class="card__category">Pagamentos</p>
                        <h3 class="card__heading"> Pagamentos Realizados </h3>
                    </div>
                </a>
                <a class="card" href="calen/index.php">
                    <div class="card__background"
                        style="background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEitU-PVqEDxdQechVNbSX4tQL09DoAPQjnr9hdDgItFrHfmqohOlvJrroneorrHFzRJwjxNeQox7wMBfYFERrJsMg6AnhYVIx__YvBxIu0xwODsL0fn9GgFWXzqrV5na3fgg66G34lh4rs/s1600/CIMG0108.JPG)">
                    </div>
                    <div class="card__content">
                        <p class="card__category">Reuniões</p>
                        <h3 class="card__heading"> Reuniões Marcadas</h3>
                    </div>
                </a>
                <a class="card" href="acessorios/index.php">
                    <div class="card__background"
                        style="background-image: url(https://www.dancastipicas.com/wp-content/uploads/2018/11/dan%C3%A7as-t%C3%ADpicas-da-regi%C3%A3o-sul-do-brasil-600x381.jpg)">
                    </div>
                    <div class="card__content">
                        <p class="card__category">Roupas</p>
                        <h3 class="card__heading"> Vestimentas</h3>
                    </div>
                </a>
                <a class="card" href="participantes/index.php">
                    <div class="card__background"
                        style="background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhjBg2Sx6qaB7z73rXl3TaDr9jnqt7V7sV6M7WHoM__eA_qXn7mTIYqiFjNHN4MHCs6rOEpxOY7orHTvckT6wxUba77D-6gFjQYhOkh0pgzZFvXEDr7IXjfF0BWVPm55OZpE-18JusWEWjK/s1600/PAR.JPG)">
                    </div>
                    <div class="card__content">
                        <p class="card__category">Participantes</p>
                        <h3 class="card__heading"> Participantes</h3>
                    </div>
                </a>
            </div>
        </section>
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
    <script src="java/main.js"></script>
    <script src="java/script.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>