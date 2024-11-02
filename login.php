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
    <style>
        /* Estilos do contêiner de carregamento */
        body,
        html {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #333;
            overflow: hidden;
        }

        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Estilos do círculo animado */
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.2);
            border-top: 5px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 10px;
        }

        /* Texto de carregamento */
        .loading-text {
            font-size: 1.2em;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        /* Animação de rotação */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .spinner {
                width: 40px;
                height: 40px;
                border-width: 4px;
            }

            .loading-text {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            .spinner {
                width: 30px;
                height: 30px;
                border-width: 3px;
            }

            .loading-text {
                font-size: 0.9em;
            }
        }
    </style>
    <div class="loading-container">
        <div class="spinner"></div>
        <div class="loading-text">Carregando...</div>
    </div>
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