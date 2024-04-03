<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="img/img/icon.png">
    <title>Sentinela da fronteira</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" media="screen"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</head>

<body>


<?php
 include ("../conexao.php");
 $sql = "SELECT * FROM usuario WHERE id_usuario ";   
 $resultado = mysqli_query($conexao, $sql);
 $dados = mysqli_fetch_assoc($resultado);


 ?>
    <!-- header -->
    <header class="navbar navbar-expand-lg navbar-light bg-light top" style="background-color: ;">
        <div class="container">
            <a class="navbar-brand">
                <img src="../img/icno.jpg" class="imgs" height="50px" width="50px"> Sentinela da Fronteira
                <?php echo "<a href='index.php' class='btn btn-danger'>Sair</a>"; ?>
    </header>
<!--menu-lateral-->
    <nav class="menu-lateral">

        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div>
        <!--btn-expandir-->

        <ul>
            <li class="item-menu ativo">
                <a href="#">
                    <span class="icon"><i class="bi bi-house-door"></i></span>
                    <span class="txt-link">Home</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-columns-gap"></i></span>
                    <span class="txt-link">Dashboard</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="calen/index.php">
                    <span class="icon"><i class="bi bi-calendar3"></i></span>
                    <span class="txt-link">Agenda</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-gear"></i></span>
                    <span class="txt-link">Configurações</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-person-circle"></i></span>
                    <span class="txt-link">Conta</span>
                </a>
            </li>
        </ul>

    </nav>


    
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulário de Roupas</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Roupa</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($dados['genero'] = 'M'){
                        
                    }else {

                        
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>




    <footer class="text-center text-white" style="background-color: #2d3548;">

        <div class="container p-4 pb-0">

            <section class="">
                <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3">
                        <a href="https://www.instagram.com/ptgsentinelaoficial/">
                            <img src="../img/img/instagram.png" height="20px" width="20px"></a>

                        <a
                            href="https://www.facebook.com/pages/Piquete%20Sentinela%20Da%20Fronteira/843171032373964/photos/?locale=pt_BR">
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



    <script src="../java/dash.js"></script>
</body>

</html>