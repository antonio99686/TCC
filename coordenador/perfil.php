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

    <link rel="shortcut icon" href="img/img/icon.png">
    <title>sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand"> Sentinela da Fronteira</a>
            <?php
            include ("../conexao.php");
            $sql = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION["id_usuario"];
            $resultado = mysqli_query($conexao, $sql);
            $dados = mysqli_fetch_assoc($resultado);
           // https://www.w3schools.com/howto/img_avatar.png
            ?>
            <div class="cor">
                <?php
                echo "" . $_SESSION["nome"];
                ?>
            </div>
            <?php
            echo "<a href='dashbord.php' class='btn btn-danger'>Voltar</a>";
            ?>
        </div>
    </nav>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/perfil.css">






    <div class='banner'>
        <img class='image-banner' src='../img/bandeira.jpg'></img>
    </div>



    <div class='profile-images'>
        <div class='user-stuff'>
            <div class="bottom-right">
                <img src='<?php echo $dados['imagem']?>' width="150px" height="150px"></img>
                
            </div>

            <div class="bottom-right"> <img class='image-3'
                    src='https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn.emojidex.com%2Femoji%2Fseal%2Fgreen_circle.png%3F1524351848&f=1'></img>
            </div>
        </div>
    </div>

    <div class='container'>
    </div>

    <div class='about'>
        <h2 class='pro-info'>Dados</h2>
        <hr>
        <div class="pos">
            <ul>
                <li>
                    <h4 class='user-heading-for-profile-info'>Nome:</h4>
                </li>
                <span class='user-span-info'>
                    <?php echo $dados['nome']; ?>
                </span>

                <li>
                    <h4 class='user-heading-for-profile-info'>Matricula:</h4>
                </li>
                <span class='user-span-info'>
                    <?php echo $dados['usuario']; ?>
                </span>

                <li>
                    <h4 class='user-heading-for-profile-info'>E-mail:</h4>
                </li>
                <span class='user-span-info'>
                    <?php echo $dados['email']; ?>
                </span>

                <li>
                    <h4 class='user-heading-for-profile-info'>CPF:</h4>
                </li>
                <span class='user-span-info'>
                    <?php echo $dados['CPF']; ?>
                </span>
                <li>
                    <h4 class='user-heading-for-profile-info'>RG:</h4>
                </li>
                <span class='user-span-info'>
                    <?php echo $dados['RG']; ?>
                </span>
                <li>
                    <h4 class='user-heading-for-profile-info'>Categoria:</h4>
                </li>
                <span class='user-span-info'>
                    <?php echo $dados['tipo']; ?>
                </span>

                <div class="pos1">

                    <li>
                        <h4 class='user-heading-for-profile-info'>Contato:</h4>
                    </li>
                    <span class='user-span-info'>
                        <?php echo $dados['telefone']; ?>
                    </span>
                    <li>
                        <h4 class='user-heading-for-profile-info'>Endereço:</h4>
                    </li>
                    <span class='user-span-info'>
                        <?php echo $dados['endereco']; ?>
                    </span>
                    <li>
                        <h4 class='user-heading-for-profile-info'>Responsavel:</h4>
                    </li>
                    <span class='user-span-info'>
                        <?php echo $dados['responsavel']; ?>
                    </span>
                    <li>
                        <h4 class='user-heading-for-profile-info'>Data de Entrada:</h4>
                    </li>
                    <span class='user-span-info'>
                        <?php echo $dados['data_entrada']; ?>
                    </span>
                    <li>
                        <h4 class='user-heading-for-profile-info'>Telefone do Responsavel:</h4>
                    </li>
                    <span class='user-span-info'>
                        <?php echo $dados['tele_respon']; ?>
                    </span>
                </div>
        </div>

        </ul>
    </div>







    </div>