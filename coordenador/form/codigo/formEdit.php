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
    // Aguarda 1 segundo antes de redirecionar o usuário
    sleep(1);
    // Conecta ao banco de dados
    require_once "../../../conexao.php";
    $conexao = conectar();

    // Verifica se o ID do usuário está definido na URL
    if (isset($_GET['id_usuario'])) {
        // Recebe o ID do usuário da URL
        $id_usuario = $_GET['id_usuario'];

        // Consulta SQL para obter os dados do usuário
        $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
        $resultado = mysqli_query($conexao, $sql);

        // Verifica se a consulta retornou resultados
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Extrai os dados do usuário
            $dados = mysqli_fetch_assoc($resultado);

            // Define os dados do usuário
            $id_usuario = $dados['id_usuario'];
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset(
        $_POST['nome'],
        $_POST['senha'],
        $_POST['email'],
        $_POST['CPF'],
        $_POST['datas'],
        $_POST['statuss'],
        $_POST['RG'],
        $_POST['categoria'],
        $_POST['telefone'],
        $_POST['endereco'],
        $_POST['responsavel'],
        $_POST['data_entrada'],
        $_POST['tele_respon'],
        $_POST['idade'],
        $_POST['nom_dan'],
        $_POST['genero']
    )) {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        $CPF = $_POST['CPF'];
        $datas = $_POST['datas'];
        $statuss = $_POST['statuss'];
        $RG = $_POST['RG'];
        $categoria = $_POST['categoria'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $responsavel = $_POST['responsavel'];
        $data_entrada = $_POST['data_entrada'];
        $tele_respon = $_POST['tele_respon'];
        $idade = $_POST['idade'];
        $nom_dan = $_POST['nom_dan'];
        $genero = $_POST['genero'];

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
                genero='$genero'
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
    ?>
</body>

</html>
