<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Roupas</title>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-v+8XDw4y9x7Syrj9vNTU69WCg5gRKE5CgEIKl6b0o5bCrPv/ZzWw9CC1PBnAVlfKWft3j1GOpx6v6miHV1ZkNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>


    <?php
    include ("../conexao.php");
    $sql = "SELECT * FROM usuario WHERE id_usuario ";   
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($resultado);


    ?>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="background-color: ;">
        <div class="container">
            <a class="navbar-brand">
                <img src="../img/icno.jpg" class="imgs" height="50px" width="50px"><a href=""></a> Sentinela da
                Fronteira
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
        </div>
        <?php echo "<a href='../dashbord.php' class='btn btn-danger'>Sair</a>"; ?>
    </nav>

    <br>
    <br>
    <br>
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
                    if ($dados['genero'] === "M") {
                        // Aqui você deve substituir esta seção com os dados do seu banco de dados
                        // Simulação de dados de roupas
                        $roupas = array(
                            array("nome" => "Bombacha", "status" => "devolvida"),
                            array("nome" => "Camisa", "status" => "pendente"),
                            array("nome" => "Colete", "status" => "devolvida"),
                            array("nome" => "Espora", "status" => "pendente"),
                            array("nome" => "Guaiaca", "status" => "pendente"),
                            array("nome" => "lenço", "status" => "pendente"),
                            array("nome" => "Chapéu", "status" => "pendente"),

                        );

                        foreach ($roupas as $roupa) {
                            $icone_status = ($roupa['status'] == 'pendente') ? 'fa-exclamation-circle text-warning' : 'fa-check-circle text-success';
                            ?>
                            <tr>
                                <td>
                                    <?php echo $roupa['nome']; ?>
                                </td>
                                <td><i class="fas <?php echo $icone_status; ?>"></i>
                                    <?php echo ucfirst($roupa['status']); ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Aqui você deve substituir esta seção com os dados do seu banco de dados
                        // Simulação de dados de roupas
                        $roupas = array(
                            array("nome" => "Brinco", "status" => "devolvida"),
                            array("nome" => "Lenço de Mão", "status" => "pendente"),
                            array("nome" => "Flor", "status" => "devolvida"),
                            array("nome" => "Vestido", "status" => "pendente"),
                            

                        );

                        foreach ($roupas as $roupa) {
                            $icone_status = ($roupa['status'] == 'pendente') ? 'fa-exclamation-circle text-warning' : 'fa-check-circle text-success';
                            ?>
                            <tr>
                                <td>
                                    <?php echo $roupa['nome']; ?>
                                </td>
                                <td><i class="fas <?php echo $icone_status; ?>"></i>
                                    <?php echo ucfirst($roupa['status']); ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <section class="">
        <!-- footer  -->
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
</body>

</html>