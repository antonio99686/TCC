<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <title>Sentinela da Fronteira - Atualização</title>
</head>
<body>
    
</body>
</html>
<?php
require_once "../conexao.php";
$conexao = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletar dados do formulário
    $id_usuario = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $datas = $_POST['datas'];
    $status = $_POST['status'];
    $CPF = $_POST['CPF'];
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

    // Atualizar os dados no banco de dados
    $sql = "UPDATE usuario SET 
                nome = '$nome', email = '$email', senha = '$senha', datas = '$datas', categoria = '$status', 
                CPF = '$CPF', RG = '$RG', categoria = '$categoria', telefone = '$telefone', endereco = '$endereco', 
                responsavel = '$responsavel', data_entrada = '$data_entrada', tele_respon = '$tele_respon', 
                idade = '$idade', nom_dan = '$nom_dan', genero = '$genero'
            WHERE id_usuario = $id_usuario";

    if ($conexao->query($sql) === TRUE) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Dados atualizados com sucesso!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '../index.php';
            });
        </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Erro ao atualizar os dados: " . $conexao->error . "',
                showConfirmButton: true
            });
        </script>";
    }
}

// Verifica se o parâmetro ID foi passado
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    // Query para selecionar os dados do usuário pelo ID
    $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        // Loop pelos resultados e atribui às variáveis PHP
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $email = $row['email'];
        $senha = $row['senha'];
        $datas = $row['datas'];
        $status = $row['categoria'];
        $CPF = $row['CPF'];
        $RG = $row['RG'];
        $categoria = $row['categoria'];
        $telefone = $row['telefone'];
        $endereco = $row['endereco'];
        $responsavel = $row['responsavel'];
        $data_entrada = $row['data_entrada'];
        $tele_respon = $row['tele_respon'];
        $idade = $row['idade'];
        $nom_dan = $row['nom_dan'];
        $genero = $row['genero'];
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Nenhum resultado encontrado para o ID especificado.',
                showConfirmButton: true
            });
        </script>";
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'ID de usuário não especificado.',
            showConfirmButton: true
        });
    </script>";
}
?>
