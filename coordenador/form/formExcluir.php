<?php
include("conexao.php");

$id = $_GET['id_usuario'];

$sql = "SELECT * FROM usuario WHERE id_usuario = $id";
$resultado = mysqli_query($conexao, $sql);
$escolhas = mysqli_fetch_assoc($resultado);

$sql = "DELETE FROM usuario WHERE id_usuario = $id";
mysqli_query($conexao, $sql);

// script para exibir o alerta
echo '<script>alert("Excluído com sucesso!");</script>';

// Redireciona para a página de lista
header('Location: lista.php');
?>
  <!-- =======INSERT INTO `usuario` (`id_usuario`, `statuss`, `nome`, `email`, `datas`, `CPF`, `RG`, `categoria`, `senha`, `telefone`, `matricula`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `idade`, `nom_dan`) VALUES
(1, 1, 'Antonio Carlos Mattes Mongelo', 'antoniomattes72@gmail.com', '2006-08-10', '05500840029', '2108268794', 'juvenil', '123', '5596860344', '2022324018', 'antonionMong.png', 'M', 'cohab 2', 'Raquel Mattes Mongelo', '2022-10-06', '55999982163', '17', ''),
(2, 3, 'Raquel Mattes Mongelo', 'Raquelmattes88@gmail.com', '1975-09-12', '80610420020', '1234567890', 'adulto', '123', '55999982163', '2022324058', 'raquel.jpg', 'F', 'cohab 2', 'proprio', '2034-04-12', '', '48', 'Luce Terezinha Mattes Mongelo'),
(3, 2, 'Jean de Souza', 'jean@gmail.com', '1974-05-31', '12345678900', '1234567980', 'adulto', '123', '5596441634', '2022325874', 'jean.png', 'M', 'cohab 2', 'proprio', '2022-10-05', '', '50', '');
COMMIT; ====== -->