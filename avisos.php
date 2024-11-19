<?php
require_once "conexao.php";  // Inclui o arquivo de conexão
$conexao = conectar();  // Estabelece a conexão com o banco de dados

// Consultar avisos
$sql = "SELECT * FROM avisos ORDER BY data_criacao DESC";
$result = $conexao->query($sql);  // Faz a consulta diretamente

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <style>
        /* Estilos personalizados para os avisos */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #2196F3;
            margin-bottom: 30px;
        }

        .info {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }

        .collection-item {
            border-left: 5px solid #2196F3;
            margin-bottom: 15px;
        }

        .collection-item .title {
            font-size: 1.5em;
            color: #333;
        }

        .collection-item p {
            font-size: 1.1em;
            color: #555;
        }

        .collection-item small {
            color: #888;
        }

        .collection {
            padding: 0;
        }

        ul.collection {
            margin: 0;
        }

        /* Adicionar uma borda e uma sombra nas mensagens */
        .collection-item p {
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        /* Estilo do botão para adicionar um aviso */
        button.btn {
            background-color: #2196F3;
            width: 100%;
            font-size: 1.2em;
            margin-top: 20px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .info {
                padding: 20px;
            }
        }
    </style>

    <div class="info">
        <h2>Avisos</h2>
        
        <?php if ($result->num_rows > 0): ?>
            <ul class="collection">
                <?php while ($aviso = $result->fetch_assoc()): ?>
                    <li class="collection-item">
                        <span class="title"><?= htmlspecialchars($aviso['titulo']); ?></span>
                        <p><?= nl2br(htmlspecialchars($aviso['mensagem'])); ?></p>
                        <p><small>Publicado em: <?= date('d/m/Y H:i', strtotime($aviso['data_criacao'])); ?></small></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Não há avisos disponíveis.</p>
        <?php endif; ?>
    </div>

</body>
</html>
