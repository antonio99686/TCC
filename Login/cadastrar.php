<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Cadastro</title>
</head>

<body>

<?php
// Conecta ao banco de dados
require_once '../conexao.php';
$conexao = conectar();

// Verifica se os dados do formulário foram recebidos corretamente
if (isset($_POST['usuario'], $_POST['senha'], $_POST['status'], $_POST['CPF'], $_POST['genero'], $_POST['idade'], $_POST['endereco'], $_POST['data_entrada'])) {

    // Dados do formulário
    $nome = $_POST['usuario'];
    $senha = $_POST['senha']; 
    $status = $_POST['status'];
    $CPF = $_POST['CPF'];
    $genero = $_POST['genero'];
    $idade = $_POST['idade'];
    $endereco = $_POST['endereco'];
    $data_entrada = $_POST['data_entrada'];
    $responsavel = $_POST['responsavel']; 
    $tele_respon = $_POST['tele_respon']; 
    $RG = $_POST['RG']; 
    $email = $_POST['email']; 
    $telefone = $_POST['telefone']; 
    $categoria = $_POST['categoria']; 
    $nom_dan = $_POST['nom_dan']; 
    $datas = $_POST['datas']; 
    $img = 'perfil.jpg'; 

    // Criptografia (password_hash)
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    // Comando SQL para inserção
    $sql = "INSERT INTO usuario (nome, statuss, senha, CPF, imagem, genero, idade, endereco, data_entrada, responsavel, tele_respon, nom_dan,RG,email,telefone,categoria,datas) 
            VALUES ('$nome', '$status', '$hash', '$CPF', '$img', '$genero', '$idade', '$endereco', '$data_entrada', '$responsavel', '$tele_respon', '$nom_dan','$RG','$email','$telefone','$categoria','$datas')";

    // Executa o comando SQL
    if (mysqli_query($conexao, $sql)) {
        // Obtém o ID do usuário inserido
        $id_usuario = mysqli_insert_id($conexao);

        // Inserir roupas correspondentes ao gênero
        if ($genero == 'M') {
            $roupas = [
                'Bombacha', 'Espora',
                'Lenço', 'Chapéu',
                'Camisa', 'Lenço de mão',
                'Faixa', 'Colete'
            ];
        } elseif ($genero == 'F') {
            $roupas = ['Flor', 'Lenço', 'Vestido','Brinco'];
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Gênero não especificado corretamente.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '../index.php';
                });
            </script>";
            exit();
        }

        foreach ($roupas as $roupa) {
            $sql = "INSERT INTO roupas (nome, id_usuario) VALUES ('$roupa', $id_usuario)";
            $conexao->query($sql);
        }

        // SweetAlert2 para sucesso
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Usuário e roupas cadastradas com sucesso!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '../index.php';
            });
        </script>";
        exit();
    } else {
        // SweetAlert2 para falha na inserção
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Falha ao cadastrar Usuário.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '../index.php';
            });
        </script>";
    }
} else {
    // SweetAlert2 para dados incompletos
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Atenção!',
            text: 'Dados do formulário incompletos.',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
}
?>

</body>
</html>
