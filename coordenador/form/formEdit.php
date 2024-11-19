<?php
require_once "../../conexao.php";
$conexao = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletar dados do formulário
    $id_usuario = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $datas = $_POST['datas'];
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
                nome = '$nome', email = '$email', datas = '$datas', 
                CPF = '$CPF', RG = '$RG', categoria = '$categoria', telefone = '$telefone', endereco = '$endereco', 
                responsavel = '$responsavel', data_entrada = '$data_entrada', tele_respon = '$tele_respon', 
                idade = '$idade', nom_dan = '$nom_dan', genero = '$genero'
            WHERE id_usuario = $id_usuario";

    if ($conexao->query($sql) === TRUE) {
        echo "<script>
            alert('Dados atualizados com sucesso!');
            window.location.href = 'lista.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao atualizar os dados: " . $conexao->error . "');
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
        $datas = $row['datas'];
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
        echo "<script>
            alert('Nenhum resultado encontrado para o ID especificado.');
        </script>";
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    echo "<script>
        alert('ID de usuário não especificado.');
    </script>";
}
?>

<!-- Outros campos do formulário para edição do usuário -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Editar Usuário</title>
    <link rel="shurtcut icon" href="img/cadastro.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
            margin: 0;
        }

        .container {
            width: 90%;
            max-width: 500px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container header {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .container header img {
            width: 60px;
        }

        h1 {
            text-align: center;
            font-size: 1.8em;
            color: #333;
            margin: 0 0 20px;
        }

        .form_grupo {
            margin-bottom: 15px;
        }

        .form_label {
            font-weight: 500;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .form_input,
        .dropdown {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .dropdown {
            appearance: none;
            background: #ffffff url('data:image/svg+xml;utf8,<svg viewBox="0 0 10 5" xmlns="http://www.w3.org/2000/svg"><path d="M0 0l5 5 5-5H0z" fill="%23777"/></svg>') no-repeat right 10px center;
            background-size: 10px 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-control:hover {
            background-color: #45a049;
        }

        .form_grupo:last-of-type {
            margin-top: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <header>
            <img src="../../img/icno.jpg" alt="Logo" class="logo" />
        </header>
        <h1>Atualização do Usuário</h1>
        <form class="form" action="formEdit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="<?php echo isset($id_usuario) ? $id_usuario : ''; ?>">

            <div class="form_grupo">
                <label for="nome" class="form_label">Nome</label>
                <input type="text" name="nome" class="form_input" value="<?php echo isset($nome) ? $nome : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="email" class="form_label">Email</label>
                <input type="email" name="email" class="form_input" value="<?php echo isset($email) ? $email : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="datas" class="form_label">Data de Nascimento</label>
                <input type="date" name="datas" class="form_input" value="<?php echo isset($datas) ? $datas : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="status" class="form_label">Categoria</label>
                <input type="text" name="categoria" class="form_input" value="<?php echo isset($categoria) ? $categoria : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="idade" class="form_label">Idade</label>
                <input type="number" name="idade" class="form_input" value="<?php echo isset($idade) ? $idade : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="genero" class="form_label">Gênero</label>
                <input type="text" name="genero" class="form_input" value="<?php echo isset($genero) ? $genero : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="CPF" class="form_label">CPF</label>
                <input type="text" name="CPF" class="form_input" value="<?php echo isset($CPF) ? $CPF : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="RG" class="form_label">RG</label>
                <input type="text" name="RG" class="form_input" value="<?php echo isset($RG) ? $RG : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="telefone" class="form_label">Telefone</label>
                <input type="tel" name="telefone" class="form_input" value="<?php echo isset($telefone) ? $telefone : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="endereco" class="form_label">Endereço</label>
                <input type="text" name="endereco" class="form_input" value="<?php echo isset($endereco) ? $endereco : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="responsavel" class="form_label">Responsável</label>
                <input type="text" name="responsavel" class="form_input" value="<?php echo isset($responsavel) ? $responsavel : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="data_entrada" class="form_label">Data de Entrada</label>
                <input type="date" name="data_entrada" class="form_input" value="<?php echo isset($data_entrada) ? $data_entrada : ''; ?>" required>
            </div>

            <div class="form_grupo">
                <label for="tele_respon" class="form_label">Telefone do Responsável</label>
                <input type="tel" name="tele_respon" class="form_input" value="<?php echo isset($tele_respon) ? $tele_respon : ''; ?>">
            </div>

            <div class="form_grupo">
                <label for="nom_dan" class="form_label">Nome do Dançarino</label>
                <input type="text" name="nom_dan" class="form_input" value="<?php echo isset($nom_dan) ? $nom_dan : ''; ?>">
            </div>

            <div class="form_grupo">
                <input type="submit" value="Enviar" class="form-control">
            </div>
        </form>
    </div>
    </div>

    <script>
        function showSuccessMessage() {
            Swal.fire({
                title: 'Sucesso!',
                text: 'Dados atualizados com sucesso!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'lista.php';
            });
        }

        function showErrorMessage(error) {
            Swal.fire({
                title: 'Erro',
                text: error,
                icon: 'error',
                confirmButtonText: 'Tentar Novamente'
            });
        }

        <?php if (isset($updateStatus) && $updateStatus === 'success'): ?>
            showSuccessMessage();
        <?php elseif (isset($updateStatus) && $updateStatus === 'error'): ?>
            showErrorMessage("Erro ao atualizar os dados.");
        <?php endif; ?>
    </script>
</body>

</html>