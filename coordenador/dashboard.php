<?php
session_start();
include("conexao.php");
$sql = "SELECT * FROM coordenador";
$resultado = mysqli_query($conexao, $sql);
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
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Principal ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="imgs/customer01.jpg" alt="">
                </div>
            </div>

           <!-- Conteúdo da página -->
    <section class="py-5">
        <div class="container">
            <br>
            <br>
            <br>
            <h1 class="fw-light">Bem-vindo(a)</h1>
            <p class="lead">
                <?php echo $dados['nome'] ?>
            </p>
            <img src="img/<?php echo $dados['imagem']?>" height="150px" width="150px" >
        </div>
    </section>

    <div class="infor">
        <h2> DADOS</h2>
        <?php
        echo "Nome: "; 
        echo $dados['nome'] 
        ?>
        <br>
        <?php 
        echo "E-mail: "; 
        echo $dados['email'] 
        ?>
        <br>
        <?php 
        echo "CPF: "; 
        echo $dados['CPF'] 
        ?>
        <br>
        <?php 
        echo "Nascimento: "; 
        echo $dados['nascimento'] 
        ?>
        <br>
        <?php 
        echo "Idade: "; 
        echo $dados['idade'] 
        ?>
        <br>
        <?php 
        echo "RG: "; 
        echo $dados['RG'] 
        ?>
        <br>
        <?php 
        echo "Data de Entrada: "; 
        echo $dados['data_entrada'] 
        ?>
        <br>
        <?php 
        echo "Endereço: "; 
        echo $dados['endereco'] 
        ?>
        <br>
    </div>

    <div class="cardss">
        <section class="hero-section">
            <div class="card-grid">
                <a class="card" href="../pagamento">
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
    
    <section class="">
        <footer class="text-center text-white" style="background-color: #2d3548;">
            <div class="container p-4 pb-0">
                <section class="">
                    <p class="d-flex justify-content-center align-items-center">
                        <span class="me-3">
                            <a href="https://www.instagram.com/ptgsentinelaoficial/" >
                                <img src="../img/img/instagram.png" height="20px" width="20px">
                            </a>
                            <a href="https://www.facebook.com/pages/Piquete%20Sentinela%20Da%20Fronteira/843171032373964/photos/?locale=pt_BR"> 
                                <img src="../img/img/facebook.png" height="20px" width="20px">
                            </a>
                        </span>
                    </p>
                </section>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                Sentinela da Fronteira
            </div>
        </footer>
    </section>
         
           
    <!-- =========== Scripts =========  -->
    <script src="../java    /main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>