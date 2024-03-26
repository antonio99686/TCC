<?php
//conecta ao banco de dado
include('conexao.php');

$id =  $_POST['id'];
$nome =  $_POST['usuario'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$datas = $_POST['nascimento'];
$CPF = $_POST['cpf'];
$RG = $_POST['RG'];
$tipo = $_POST['tipo'];
$telefone = $_POST['telefone'];

if (isset($_FILES['arquivo'])) {
    
    //define o nome do arquivo
    $novo_nome = $_FILES['arquivo']['name'];

    //define a pasta para onde enviaremos o arquivo
    $diretorio = "img/";

    //faz o upload, movendo o arquivo para a pasta especificada
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome); 

//cadastra no banco
$sql = "UPDATE usuario SET nome = '$nome', email = '$email', datas = '$datas',
CPF = '$CPF',RG = '$RG',senha = '$senha',tipo = '$tipo',telefone = '$telefone', imagem = '$novo_nome' WHERE id = $id";


if (mysqli_query($conexao, $sql)){
  echo "Arquivo enviado com sucesso!";
  header ('Location: index.php ');
}else{
  echo "Falha ao enviar arquivo.";

}
}

?>
<div class="corpo">

<div class="card verde">
  <h2><a href="pagamentos/index.php">Pagamentos</a></h2>
  <p>Visualize os pagamentos a serem realizados </p>
</div>


<div class="azul card">
  <h2><a href="agenda/index.php">Reuniões</a></h2>
  <p>Visualizar as reuniões marcadas</p>
</div>

<div class="card vermelho">
  <h2><a href="acessorios/index.php ">Vestimentas</a></h2>
  <p>Visualize as vestimentas </p>
</div>

<div class="card roxo">
  <h2><a href="participantes/index.php">Participantes</a></h2>
  <p>Visualize os participantes </p>
</div>
</div>