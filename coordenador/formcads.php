<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashbord.css">

    <link rel="shortcut icon" href="../img/img/icon.png">
    <title>Sentinela da fronteira</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</head>

<body>


    <?php
    include ("conexao.php");
    $sql = "SELECT * FROM coordenador;";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($resultado);

    ?>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="background-color: ;">
        <div class="container">
            <a class="navbar-brand" >
                <img src="../img/icno.jpg"  class="imgs" height="50px" width="50px"><a href=""></a> Sentinela da Fronteira
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="dashbord.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="formcads.php">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="roupa.php">Roupa</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php echo "<a href='dashbord.php' class='btn btn-danger'>Sair</a>"; ?>
    </nav>


    <!-- Page Content -->
    <section class="py-5">
        <div class="container">
            <br>
            <br>
            <br>
            <h1 class="fw-light">Olá,<?php echo $dados['nome'] ?> </h1>
            <p class="lead">
            O que gostaria de fazer?
            </p>
            <img src="img/ <?php echo $dados['imagem']?>" height="150px" width="150px" >
        </div>
    </section>
    





    <div class="cardss">


        <section class="hero-section">
            <div class="card-grid">
                <a class="card" href="form/formcadD.php">
                    <div class="card__background"
                        style="background-image: url(https://www.gruporecovery.com/wp-content/uploads/2023/09/MicrosoftTeams-image-1.png)">
                    </div>
                    <div class="card__content">
                        <p class="card__category">Dançarino</p>
                        <h3 class="card__heading"> Cadastrar Dançarino </h3>
                    </div>
                </a>
                <a class="card" href="form/formcadP.php">
                    <div class="card__background"
                        style="background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEitU-PVqEDxdQechVNbSX4tQL09DoAPQjnr9hdDgItFrHfmqohOlvJrroneorrHFzRJwjxNeQox7wMBfYFERrJsMg6AnhYVIx__YvBxIu0xwODsL0fn9GgFWXzqrV5na3fgg66G34lh4rs/s1600/CIMG0108.JPG)">
                    </div>
                    <div class="card__content">
                        <p class="card__category">Responsável</p>
                        <h3 class="card__heading"> Cadastrar Responsável </h3>
                    </div>
                </a>
                <a class="card" href="form/formcadC.php">
                    <div class="card__background"
                        style="background-image: url(https://www.dancastipicas.com/wp-content/uploads/2018/11/dan%C3%A7as-t%C3%ADpicas-da-regi%C3%A3o-sul-do-brasil-600x381.jpg)">
                    </div>
                    <div class="card__content">
                        <p class="card__category">Coordenador</p>
                        <h3 class="card__heading"> Cadastrar Coordenador</h3>
                    </div>
                    </li>
                    <a class="card" href="participantes/index.php">
                        <div class="card__background"
                            style="background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhjBg2Sx6qaB7z73rXl3TaDr9jnqt7V7sV6M7WHoM__eA_qXn7mTIYqiFjNHN4MHCs6rOEpxOY7orHTvckT6wxUba77D-6gFjQYhOkh0pgzZFvXEDr7IXjfF0BWVPm55OZpE-18JusWEWjK/s1600/PAR.JPG)">
                        </div>
                        <div class="card__content">
                            <p class="card__category">Participantes</p>
                            <h3 class="card__heading"> Participantes</h3>
                        </div>
                    </a>
                    <div>


                        <!-- Footer -->

        </section>

    </div>

    <section class="">

        <footer class="text-center text-white" style="background-color: #2d3548;">

            <div class="container p-4 pb-0">

                <section class="">
                    <p class="d-flex justify-content-center align-items-center">
                        <span class="me-3">
                        <a href="https://www.instagram.com/ptgsentinelaoficial/" >
                        <img src="../img/img/instagram.png" height="20px" width="20px"></a>

                        <a href="https://www.facebook.com/pages/Piquete%20Sentinela%20Da%20Fronteira/843171032373964/photos/?locale=pt_BR"> 
                     <img src="../img/img/facebook.png" height="20px" width="20px"></a>


                        </span>
                        
                        <!-- <button data-mdb-ripple-init type="button" class="btn btn-outline-light btn-rounded">

                        </button>-->
                    </p>
                
                </section>

            </div>



            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                Sentinela da Fronteira

            </div>

        </footer>

    </section>


</body>

</html>