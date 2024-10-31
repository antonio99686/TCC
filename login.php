<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <title>Redirecionamento</title>
</head>
<body>
   
</body>
</html>
<?php
session_start();

require_once "conexao.php";
$conexao = conectar();

$CPF = $_POST['CPF'];
$senha = $_POST['senha'];
$sql = "SELECT * FROM usuario WHERE CPF = '{$CPF}'";

$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_assoc($resultado);

if ($dados) {
    if (password_verify($senha, $dados['senha'])) {
        $_SESSION['CPF'] = $CPF;
        $_SESSION['id_usuario'] = $dados['id_usuario'];
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['statuss'] = $dados['statuss'];
        $_SESSION['genero'] = $dados['genero'];

      
        switch ($dados['statuss']) {
            case '1':
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Seja bem-vindo, " . $dados['nome'] . "',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(() => {
                        window.location.href = 'usuario/dashboard.php';
                    }, 1600);
                </script>";
                break;

            case '2':
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Seja bem-vindo, " . $dados['nome'] . "',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(() => {
                        window.location.href = 'coordenador/dashboard.php';
                    }, 1600);
                </script>";
                break;

            case '3':
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Seja bem-vindo, " . $dados['nome'] . "',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(() => {
                        window.location.href = 'usuario/dashboard.php';
                    }, 1600);
                </script>";
                break;

            default:
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'CPF ou SENHA incorretos',
                        text: 'Por favor, insira novamente.',
                    });

                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 1600);
                </script>";
                break;
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Senha incorreta',
                text: 'A senha fornecida não corresponde.',
            });

            setTimeout(() => {
                window.location.href = 'index.php';
            }, 1600);
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'CPF não encontrado',
            text: 'O CPF informado não está cadastrado.',
        });

        setTimeout(() => {
            window.location.href = 'index.php';
        }, 1600);
    </script>";
}
?>
