<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="shurtcut icon" href="../img/cadastro.png">
    <title>Cadastrar</title>
</head>

<body>
    <?php
    // Conecta ao banco de dados
    require_once "../../../conexao.php";
    $conexao = conectar();

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
        // Recebe os dados do formulário
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];  // A senha informada
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

        // Gera o hash da senha
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

        // Comando SQL para inserir o novo usuário
        $sql = "INSERT INTO usuario (
                    nome, statuss, email, datas, CPF, RG, categoria, senha, telefone, 
                    endereco, responsavel, data_entrada, tele_respon, idade, nom_dan, genero
                ) VALUES (
                    '$nome', '$statuss', '$email', '$datas', '$CPF', '$RG', '$categoria', 
                    '$senha_hash', '$telefone', '$endereco', '$responsavel', '$data_entrada', '$tele_respon', 
                    '$idade', '$nom_dan', '$genero'
                )";

        // Executa o comando SQL
        if (mysqli_query($conexao, $sql)) {
            // Usuário cadastrado com sucesso
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Usuário cadastrado com sucesso!',
                    timer: 3000, // 3 segundos
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '../lista.php'; // Redireciona para a lista de usuários
                });
            </script>";
            exit();
        } else {
            // Falha ao cadastrar o usuário
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Falha ao cadastrar o usuário. Por favor, tente novamente.',
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
