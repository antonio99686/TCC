<?php
session_start();
include("../conexao.php");
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

    <link rel="stylesheet" href="index.css">

   
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

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sair</span>
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
                        <input type="text" placeholder="Pesquisar">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
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
                <?php echo $dados['nome'] ?>
            </p>
            <img src="img/<?php echo $dados['imagem']?>" height="150px" width="150px" >
        </div>
    </section>

    <div class="card_meio">        
        <div class="card verde">
        <a href="formcadD.php">  <h2>Dançarino</h2>
          <p>visualize os pagamentos a serem realizados </p>
        </a>
        </div>       
        <div class="card azul">
        <a href="formcadC.php"> <h2>Coordenador</h2>
          <p>visualizar as reuniões marcadas</p>
          </a>
        </div>
        <div class="card vermelho">
        <a href="formcadP.php"><h2>Responsavel</h2>
          <p>visualize os processos  </p>
          </a>
        </div>
        
    </div>

    
    
    <section class="">
        <footer class="text-center text-white" style="background-color: #2d3548;">
            <div class="container p-4 pb-0">
                <section class="">
                    <p class="d-flex justify-content-center align-items-center">
                        <span class="me-3">
                            <a href="https://www.instagram.com/ptgsentinelaoficial/" >
                                <img src="../../img/img/instagram.png" height="20px" width="20px">
                            </a>
                            <a href="https://www.facebook.com/pages/Piquete%20Sentinela%20Da%20Fronteira/843171032373964/photos/?locale=pt_BR"> 
                                <img src="../../img/img/facebook.png" height="20px" width="20px">
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
    <script src="../../java/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>