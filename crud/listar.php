<?php
// Conectar ao BD
include("conexao.php");

// Seleciona todos os dados da tabela lista
$sql = "SELECT * FROM lista";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);

//Lista os itens
echo ' <div class="table">
  <table>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Produto</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Valor</th>
      <th scope="col">Foto</th>

    </tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
      echo "<td>" .  $dados['idLista']    .  "</td>";
      echo "<td>" .  $dados['produto']    .  "</td>";
      echo "<td>" .  $dados['quantidade'] .  "</td>";
      echo "<td>" .  $dados['valor']      .  "</td>";
      echo "<td>" .  $dados['imagem']     .  "</td>";
      echo "<td><a href='formedit.php?id=".$dados['idLista']."&nome=".$dados['produto']."&quant=".$dados['quantidade']."&valor=".$dados['valor']."'>"."<img src='img/settings.png' widht='20' height='20'"."</a>";
      echo " <a href='excluir.php?id=".$dados['idLista']."'>"."<img src='img/lixeira.png' widht='20' height='20'"."</a></td>";
    echo '</tr>';
     
}
echo '</table>
</div>';
?>