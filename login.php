<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
   <link rel="shortcut icon" href="img/img/icon.png">
   <title>LOGIN</title>
</head>
<body>

</body>
</html>
<?php
session_start();

// Verifique se o formulário foi enviado e se os campos CPF e senha estão preenchidos
if (empty($_POST['CPF']) or empty($_POST['senha'])) {
   echo "<script>alert('Por favor, preencha todos os campos.');</script>";
   exit; // Termina o script se as informações não estiverem completas
}

require_once "conexao.php";
$conexao = conectar();

$CPF = $_POST['CPF'];
$senha = $_POST['senha'];
$sql = "SELECT * FROM usuario WHERE CPF = '{$CPF}' AND senha = '{$senha}'";

$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_assoc($resultado);

$res = $conexao->query($sql) or die($conexao->error);
$row = $res->fetch_object();
$qtd = $res->num_rows;

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

if ($qtd > 0) {
   $_SESSION['CPF'] = $CPF;
   $_SESSION['id_usuario'] = $dados['id_usuario'];
   $_SESSION['nome'] = $dados['nome'];
   $_SESSION['statuss'] = $dados['statuss'];

   switch ($dados['statuss']) {
      case '1':
         echo "<script>
         Swal.fire({
             icon: 'success',
             title: 'Seja bem-vindo, " . $dados['nome'] . "',
             showConfirmButton: false,
             timer: 1500
         }).then(() => {
             location.href='dashboard.php';
         });
     </script>";

         break;
      case '2':
         echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Seja bem-vindo, " . $dados['nome'] . "',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.href='coordenador/dashboard.php';
                });
            </script>";
         break;
      case '3':
         echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Seja bem-vindo, " . $dados['nome'] . "',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.href='pais/dashboard.php';
                });
            </script>";
         break;
      default:
         echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'CPF ou SENHA incorretos',
                    text: 'Por favor, insira novamente.',
                }).then(() => {
                    location.href='index.php';
                });
            </script>";
         break;
   }
} else {
   // Se nenhum registro foi encontrado, exibe um alerta informando que o CPF ou a senha estão incorretos
   echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'CPF ou SENHA incorretos',
            text: 'Por favor, insira novamente.',
        }).then(() => {
            location.href='index.php';
        });
    </script>";
}
?>