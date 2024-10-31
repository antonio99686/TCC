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

        // Inclua o SweetAlert2 no início

        switch ($dados['statuss']) {
            case '1':
                if ($dados['primeiro_login'] == 1) {
                    $updateSql = "UPDATE usuario SET primeiro_login = 0 WHERE id_usuario = {$dados['id_usuario']}";
                    mysqli_query($conexao, $updateSql);

                    // Aqui adicionamos um setTimeout para garantir o redirecionamento
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Primeiro login!',
                            text: 'Você será redirecionado para o formulário de edição.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'login/formEdit.php?id_usuario={$dados['id_usuario']}&genero={$dados['genero']}';
                        }, 1600);
                    </script>";
                } else {
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
                }
                break;

            case '2':
                if ($dados['primeiro_login'] == 0) {
                    $updateSql = "UPDATE usuario SET primeiro_login = 1 WHERE id_usuario = {$dados['id_usuario']}";
                    mysqli_query($conexao, $updateSql);

                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Primeiro login!',
                            text: 'Você será redirecionado para o formulário de edição.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'login/formEdit.php?id_usuario={$dados['id_usuario']}&genero={$dados['genero']}';
                        }, 1600);
                    </script>";
                } else {
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
                }
                break;

            case '3':
                if ($dados['primeiro_login'] == 1) {
                    $updateSql = "UPDATE usuario SET primeiro_login = 0 WHERE id_usuario = {$dados['id_usuario']}";
                    mysqli_query($conexao, $updateSql);

                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Primeiro login!',
                            text: 'Você será redirecionado para o formulário de edição.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'login/formEdit.php?id_usuario={$dados['id_usuario']}&genero={$dados['genero']}';
                        }, 1600);
                    </script>";
                } else {
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
                }
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
//Jesus101sa
?>
