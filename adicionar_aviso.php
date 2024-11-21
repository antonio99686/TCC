<?php
require_once "conexao.php"; // Inclui o arquivo de conexão
$conexao = conectar(); // Chama a função conectar() para obter a conexão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO avisos (titulo, mensagem) VALUES ('$titulo', '$mensagem')";

   $result = mysqli_query($conexao, $sql);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aviso</title>
    <style>
      

        .caixa {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .men {
            margin-bottom: 15px;
        }

        .men label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .men input,
        .men textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .men textarea {
            resize: vertical;
            height: 100px;
        }

        .btn {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            width: 100%;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="caixa">
        <h2>Adicionar Aviso</h2>
        <form method="POST">
            <div class="men">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="men">
                <label for="mensagem">Mensagem</label>
                <textarea id="mensagem" name="mensagem" required></textarea>
            </div>
            <button type="submit" class="btn">Adicionar Aviso</button>
        </form>
    </div>
</body>
</html>
