
<?php
session_start();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <link rel="shortcut icon" href="../img/logo.png">
  <title>Sentinela da Fronteira</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand"> Sentinela da Fronteira</a>
      <?php
      include("../conexao.php");
      $sql = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION["id_usuario"];
      $resultado = mysqli_query($conexao, $sql);
      $dados = mysqli_fetch_assoc($resultado);
      echo $_SESSION["nome"];
      echo "<a href='../dashbord.php' class='btn btn-danger'>Volta</a>";
      ?>
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
/* tabela  */
      if ($dados['genero'] === "M") {

        ?>
        
      <?php } else { ?>


        <table class="ui celled structured table">
          <thead>
            <tr>
              <th rowspan="2"></th>




            </tr>
            <tr>
              <th>Entregue</th>
              <th>Devolvido</th>
              <th>Pendente</th>

            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Brinco</td>
              <td class="right aligned"></td>
              <td class="center aligned">

              </td>
              <td></td>
              <td></td>
            </tr>
            <tr>

              <td>Lenço de Mão</td>
              <td class="right aligned"></td>
              <td class="center aligned">

              </td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Flor</td>
              <td class="right aligned"></td>
              <td></td>
              <td class="center aligned">

              </td>
              <td></td>
            </tr>
            <tr>
              <td>Vestido</td>
              <td class="right aligned"></td>
              <td class="center aligned">

              </td>
              <td></td>
              <td></td>
            </tr>

          </tbody>
        </table>





      <?php } ?>







    </div>

  </nav>


</html>









</body>

</html>
