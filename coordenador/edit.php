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