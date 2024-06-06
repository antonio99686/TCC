<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
   <link rel="shortcut icon" href="img/icon.png">
   <title>LOGIN</title>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
</body>
</html>

<?php
session_start();

// Check if the form is submitted and fields are not empty
if (empty($_POST['CPF']) || empty($_POST['senha'])) {
   echo "<script>
   Swal.fire({
       icon: 'error',
       title: 'Por favor, preencha todos os campos.',
   });
   </script>";
   exit;
}

include('conexao.php');

$CPF = $_POST['CPF'];
$senha = $_POST['senha'];

// Use prepared statements to prevent SQL injection
$stmt = $conexao->prepare("SELECT * FROM usuario WHERE CPF = ?");
$stmt->bind_param("s", $CPF);
$stmt->execute();
$result = $stmt->get_result();
$dados = $result->fetch_assoc();

if ($dados && password_verify($senha, $dados['senha'])) {
   $_SESSION['CPF'] = $CPF;
   $_SESSION['id_usuario'] = $dados['id_usuario'];
   $_SESSION['nome'] = $dados['nome'];
   $_SESSION['statuss'] = $dados['statuss'];

   $redirect_url = '';
   switch ($dados['statuss']) {
      case '1':
         $redirect_url = 'dashboard.php';
         break;
      case '2':
         $redirect_url = 'coordenador/dashboard.php';
         break;
      case '3':
         $redirect_url = 'pais/dashboard.php';
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
         exit;
   }
   
   echo "<script>
   Swal.fire({
       icon: 'success',
       title: 'Seja bem-vindo, " . htmlspecialchars($dados['nome'], ENT_QUOTES, 'UTF-8') . "',
       showConfirmButton: false,
       timer: 1500
   }).then(() => {
       location.href='$redirect_url';
   });
   </script>";
} else {
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
