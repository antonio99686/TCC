<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Caixa</title>
    <!-- Adicionando Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
        }
    </style>
</head>
<body>



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
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php echo "<a href='index.php' class='btn btn-danger'>Sair</a>"; ?>
    </nav>





    <div class="container">
        <h1 class="mt-5">Sistema de Caixa</h1>
        
        <?php
        // Include do arquivo PHP que contém a lógica do caixa
        require_once 'caixa.php';

        // Inicializa o objeto de caixa
        $caixa = new Caixa(0);

        // Verifica se algum valor foi enviado via formulário
        if(isset($_POST['valor'])){
            $valor = $_POST['valor'];

            // Verifica se o valor é válido
            if(is_numeric($valor) && $valor > 0){
                // Verifica se o botão de pagamento foi clicado
                if(isset($_POST['pagar'])){
                    // Verifica se o pagamento foi bem-sucedido
                    if(Pagamento::pagarComPix($valor)){
                        $mensagem = "Pagamento de " . $valor . " reais realizado com sucesso via PIX!";
                    } else {
                        $mensagem = "Falha ao realizar o pagamento via PIX!";
                    }
                } else {
                    // Verifica se há saldo suficiente antes de realizar a compra
                    if($caixa->removerDinheiro($valor)){
                        $mensagem = "Compra de " . $valor . " reais realizada com sucesso!";
                    } else {
                        $mensagem = "Saldo insuficiente para realizar a compra!";
                    }
                }
            } else {
                $mensagem = "Por favor, insira um valor numérico válido.";
            }

            // Exibe a mensagem de retorno
            echo "<p>" . $mensagem . "</p>";
        }
        ?>

        <h2 class="mt-5">Saldo atual: <?php echo $caixa->getSaldo(); ?> reais</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="text" class="form-control" id="valor" name="valor" required>
            </div>
            <button type="submit" class="btn btn-primary" name="comprar">Comprar</button>
            <button type="submit" class="btn btn-success" name="pagar">Pagar com PIX</button>
        </form>
    </div>

    <!-- Adicionando Bootstrap JS e dependências -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<br>

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
