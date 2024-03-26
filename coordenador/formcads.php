<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formcads.css">
    <link rel="stylesheet" href="css/dashbord.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>cadastro</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Sentinela da Fronteira</a>




  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashbord.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="formcads.php">Cadastrar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Editar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="perfil.php">Perfil</a>
      </li>
    </ul>
    <div class="possisao">
    <?php echo "Olá, " . $_SESSION["nome"];?>
    </div>
  </div>

      <?php
      include ("../conexao.php");
      $sql = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION["id_usuario"];
      $resultado = mysqli_query($conexao, $sql);
      $dados = mysqli_fetch_assoc($resultado);
      echo "<a href='../index.php' class='btn btn-danger'>Sair</a>";
      ?>

</nav>


<div class="container">







</div>

    <div class="cardss">
    
        <section class="hero-section">
          <div class="card-grid">
            <a class="card" href="form/formcadP.php">
              <div class="card__background"
                style="background-image: url(https://www.gruporecovery.com/wp-content/uploads/2023/09/MicrosoftTeams-image-1.png)">
              </div>
              <div class="card__content">
                <p class="card__category">Pais</p>
                <h3 class="card__heading"> Cadastro de Pais </h3>
              </div>
            </a>
            <a class="card" href="form/formcadD.php">
              <div class="card__background"
                style="background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEitU-PVqEDxdQechVNbSX4tQL09DoAPQjnr9hdDgItFrHfmqohOlvJrroneorrHFzRJwjxNeQox7wMBfYFERrJsMg6AnhYVIx__YvBxIu0xwODsL0fn9GgFWXzqrV5na3fgg66G34lh4rs/s1600/CIMG0108.JPG)">
              </div>
              <div class="card__content">
                <p class="card__category">Dançarino</p>
                <h3 class="card__heading"> Cadastro do Dançarino</h3>
              </div>
            </a>
            <a class="card" href="form/formcadC.php">
              <div class="card__background"
                style="background-image: url(https://www.dancastipicas.com/wp-content/uploads/2018/11/dan%C3%A7as-t%C3%ADpicas-da-regi%C3%A3o-sul-do-brasil-600x381.jpg)">
              </div>
              <div class="card__content">
                <p class="card__category">Coordenador</p>
                <h3 class="card__heading">Cadastro do Coordenador</h3>
              </div>
              </li>
            
              <div>
        </section>
    
      </div>
</body>
</html>

