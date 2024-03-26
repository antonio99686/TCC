<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/lista.css">
    <link rel="shortcut icon" href="img/logo.png">
    <title>sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
<a class="navbar-brand"> Sentinela da Fronteira</a>
<?php
echo "<a href='index.php' class='btn btn-danger'>Sair</a>";
?>
    </div>

</nav>

<?php
// Conectar ao BD
include("conexao.php");

// Seleciona todos os dados da tabela lista
$sql = "SELECT * FROM usuario";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);

//Lista os itens
echo '<div class="table">
  <table>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Senha</th>
      <th scope="col">Entrada</th>
      <th scope="col">Matricula</th>
      <th scope="col">Telefone</th>
      <th scope="col">Foto</th>

    </tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
      
      echo "<td>" .  $dados['nome']         .  "</td>";
      echo "<td>" .  $dados['email']        .  "</td>";
      echo "<td>" .  $dados['senha']        .  "</td>";
      echo "<td>" .  $dados['datas']      .  "</td>";
      echo "<td>" .  $dados['usuario']      .  "</td>";
      echo "<td>" .  $dados['telefone']     .  "</td>";
      echo "<td>" .  $dados['imagem']       .  "</td>";
      echo '</tr>';
     echo "<td><a href='formedit.php?" . "&nome=".$dados['nome']."&email=".$dados['email']."&senha=".$dados['senha']."&datas=".$dados['datas']."&imagem=".$dados['imagem']."&usuario=".$dados['usuario']."&telefone=".$dados['telefone']."'>"."<img src='img/settings.png' 'widht='20' height='20'"."</a>";
     echo "<td><a href='exclui.php?" . "&nome=".$dados['nome']."&email=".$dados['email']."&senha=".$dados['senha']."&datas=".$dados['datas']."&imagem=".$dados['imagem']."&usuario=".$dados['usuario']."&telefone=".$dados['telefone']."'>"."<img src='img/lixeira.png' 'widht='20' height='20'"."</a></td>";

}
echo '</table>
</div>';
?>

       


        
        

</body>
</html>


