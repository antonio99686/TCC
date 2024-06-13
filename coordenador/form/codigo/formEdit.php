<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <title>Editar</title>
</head>

<body>
    <?php
    // Aguarda 1 segundos antes de redirecionar o usuário
    sleep(1);
    // Conecta ao banco de dados
    include ('../conexao.php');

    // Verifica se o ID do usuário está definido na URL
    if (isset($_POST['id_usuario'])) {
        // Recebe o ID do usuário da URL
        $id_usuario = $_POST['id_usuario'];

        // Consulta SQL para obter os dados do usuário
        $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
        $resultado = mysqli_query($conexao, $sql);

        // Verifica se a consulta retornou resultados
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Extrai os dados do usuário
            $dados = mysqli_fetch_assoc($resultado);

            // Define os dados do usuário
            $id_usuario =$dados['id_usuario'];
            $nome = $dados['nome'];
            $senha = $dados['senha'];
            $email = $dados['email'];
            $CPF = $dados['CPF'];
            $datas = $dados['datas'];
            $statuss = $dados['statuss'];
            $RG = $dados['RG'];
            $categoria = $dados['categoria'];
            $telefone = $dados['telefone'];
            $endereco = $dados['endereco'];
            $responsavel = $dados['responsavel'];
            $data_entrada = $dados['data_entrada'];
            $tele_respon = $dados['tele_respon'];
            $idade = $dados['idade'];
            $nom_dan = $dados['nom_dan'];
            $genero = $dados['genero'];
        } else {
            // Usuário não encontrado
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Nenhum usuário encontrado com o ID fornecido.',
                        timer: 3000, // 3 segundos
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '../lista.php'; // Redireciona após fechar o alerta
                    });
                </script>";
            exit();
        }
    } else {
        // ID do usuário não fornecido 
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ID do usuário não fornecido.',
                    timer: 3000, // 3 segundos
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '../lista.php'; // Redireciona após fechar o alerta
                });
            </script>";
        exit();
    }

    // Verifica se os dados do formulário foram recebidos corretamente
    if (isset(
        $nome,
        $senha,
        $email,
        $CPF,
        $datas,
        $statuss,
        $RG,
        $categoria,
        $telefone,
        $endereco,
        $responsavel,
        $data_entrada,
        $tele_respon,
        $idade,
        $nom_dan,
        $genero
    )) {
        // Verifica se um arquivo foi enviado
        if (isset($_FILES['arquivo'])) {
            // Verifica se houve erro no upload
            if ($_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
                // Define o nome do arquivo
                $imagem = $_FILES['arquivo']['name'];

                // Define a pasta para onde enviaremos o arquivo
                $diretorio = "../../img/";

                // Faz o upload, movendo o arquivo para a pasta especificada
                if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $imagem)) {
                    // Comando SQL para atualização
                    $sql = "UPDATE usuario SET 
                            nome='$nome',
                            statuss='$statuss',
                            email='$email',
                            datas='$datas',
                            CPF='$CPF',
                            RG='$RG',
                            categoria='$categoria',
                            senha='$senha',
                            telefone='$telefone',
                            endereco='$endereco',
                            responsavel='$responsavel',
                            data_entrada='$data_entrada',
                            tele_respon='$tele_respon',
                            idade='$idade',
                            nom_dan='$nom_dan',
                            genero='$genero',
                            imagem='$imagem'
                            WHERE id_usuario=$id_usuario";

                    // Executa o comando SQL
                    if (mysqli_query($conexao, $sql)) {
                        // Dados atualizados com sucesso
                        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Dados do usuário atualizados com sucesso!',
                    timer: 3000, // 3 segundos
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '../lista.php';
                });
            </script>";
                        exit();
                    } else {
                        // Falha ao atualizar os dados
                        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Falha ao atualizar os dados do usuário.',
                    timer: 3000, // 3 segundos
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            </script>";
                    }
                } else {
                    // Erro ao mover o arquivo
                    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Erro ao mover o arquivo.',
                timer: 3000, // 3 segundos
                timerProgressBar: true,
                showConfirmButton: false
            });
        </script>";
                }
            } else {
                // Nenhum arquivo enviado
                echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Nenhum arquivo enviado.',
            timer: 3000, // 3 segundos
            timerProgressBar: true,
            showConfirmButton: false
        });
    </script>";
            }
        } else {
            // Dados do formulário incompletos
            echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Dados do formulário incompletos.',
        timer: 3000, // 3 segundos
        timerProgressBar: true,
            showConfirmButton: false
        });
    </script>";
        }
    }
    ?>
</body>
</html>
