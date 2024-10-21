<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> <!-- Importa o CSS do SweetAlert2 para mostrar alertas visuais -->
   <title>Redirecionamento</title>
</head>
<body>
   
</body>
</html>
<?php
session_start(); // Inicia a sessão para usar variáveis de sessão

require_once "conexao.php"; // Inclui o arquivo de conexão com o banco de dados
$conexao = conectar(); // Conecta ao banco de dados usando uma função conectar() definida no arquivo de conexão

$CPF = $_POST['CPF']; // Obtém o CPF do formulário enviado pelo método POST
$senha = $_POST['senha']; // Obtém a senha do formulário enviado pelo método POST
$sql = "SELECT * FROM usuario WHERE CPF = '{$CPF}'"; // Consulta SQL para selecionar o usuário baseado no CPF informado

$resultado = mysqli_query($conexao, $sql); // Executa a consulta no banco de dados
$dados = mysqli_fetch_assoc($resultado); // Obtém os dados do usuário, se encontrados

if ($dados) { // Verifica se o CPF foi encontrado no banco de dados
    if (password_verify($senha, $dados['senha'])) { // Verifica se a senha fornecida corresponde à senha armazenada no banco
        // Armazena os dados do usuário na sessão
        $_SESSION['CPF'] = $CPF;
        $_SESSION['id_usuario'] = $dados['id_usuario'];
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['statuss'] = $dados['statuss'];
        $_SESSION['genero'] = $dados['genero'];

        // Inclui o script do SweetAlert2 para exibir alertas
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

        // Verifica o status do usuário para redirecionamento baseado em seu tipo
        switch ($dados['statuss']) {
            case '1': // Usuário comum
                if ($dados['primeiro_login'] == 0) { // Verifica se é o primeiro login
                    $updateSql = "UPDATE usuario SET primeiro_login = 1 WHERE id_usuario = {$dados['id_usuario']}"; // Atualiza o banco para marcar que o usuário já fez o primeiro login
                    mysqli_query($conexao, $updateSql);

                    // Exibe uma mensagem de sucesso com SweetAlert2 e redireciona o usuário para o formulário de edição
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Primeiro login!',
                            text: 'Você será redirecionado para o formulário de edição.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'login/formEdit.php?id_usuario={$dados['id_usuario']}&genero={$dados['genero']}'; // Redireciona para o formulário de edição
                        }, 1600);
                    </script>";
                } else { // Se não for o primeiro login
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Seja bem-vindo, " . $dados['nome'] . "',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'usuario/dashboard.php'; // Redireciona para o dashboard do usuário
                        }, 1600);
                    </script>";
                }
                break;

            case '2': // Coordenador
                if ($dados['primeiro_login'] == 1) { // Primeiro login para o coordenador
                    $updateSql = "UPDATE usuario SET primeiro_login = 0 WHERE id_usuario = {$dados['id_usuario']}"; // Atualiza o banco para marcar que o primeiro login foi feito
                    mysqli_query($conexao, $updateSql);

                    // Exibe a mensagem e redireciona para o formulário de edição
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Primeiro login!',
                            text: 'Você será redirecionado para o formulário de edição.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'login/formEdit.php?id_usuario={$dados['id_usuario']}&genero={$dados['genero']}'; // Redireciona para o formulário de edição
                        }, 1600);
                    </script>";
                } else { // Caso não seja o primeiro login
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Seja bem-vindo, " . $dados['nome'] . "',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'coordenador/dashboard.php'; // Redireciona para o dashboard do coordenador
                        }, 1600);
                    </script>";
                }
                break;

            case '3': // Outro tipo de usuário
                if ($dados['primeiro_login'] == 1) { // Verifica o primeiro login
                    $updateSql = "UPDATE usuario SET primeiro_login = 0 WHERE id_usuario = {$dados['id_usuario']}"; // Atualiza o status de primeiro login
                    mysqli_query($conexao, $updateSql);

                    // Exibe uma mensagem e redireciona para o formulário de edição
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Primeiro login!',
                            text: 'Você será redirecionado para o formulário de edição.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'login/formEdit.php?id_usuario={$dados['id_usuario']}&genero={$dados['genero']}'; // Redireciona para o formulário de edição
                        }, 1600);
                    </script>";
                } else { // Caso não seja o primeiro login
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Seja bem-vindo, " . $dados['nome'] . "',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = 'usuario/dashboard.php'; // Redireciona para o dashboard
                        }, 1600);
                    </script>";
                }
                break;

            default: // Caso o status seja inválido
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'CPF ou SENHA incorretos',
                        text: 'Por favor, insira novamente.',
                    });

                    setTimeout(() => {
                        window.location.href = 'index.php'; // Redireciona para a página de login
                    }, 1600);
                </script>";
                break;
        }
    } else { // Senha incorreta
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Senha incorreta',
                text: 'A senha fornecida não corresponde.',
            });

            setTimeout(() => {
                window.location.href = 'index.php'; // Redireciona para a página de login
            }, 1600);
        </script>";
    }
} else { // CPF não encontrado
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'CPF não encontrado',
            text: 'O CPF informado não está cadastrado.',
        });

        setTimeout(() => {
            window.location.href = 'index.php'; // Redireciona para a página de login
        }, 1600);
    </script>";
}
?>
