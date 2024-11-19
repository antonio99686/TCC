<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO avisos (titulo, mensagem) VALUES (:titulo, :mensagem)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':mensagem', $mensagem);
    
    if ($stmt->execute()) {
        echo "Aviso adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar o aviso.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aviso</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>

    <div class="container">
        <h2>Adicionar Aviso</h2>
        <form method="POST">
            <div class="input-field">
                <input type="text" id="titulo" name="titulo" required>
                <label for="titulo">Título</label>
            </div>
            <div class="input-field">
                <textarea id="mensagem" name="mensagem" class="materialize-textarea" required></textarea>
                <label for="mensagem">Mensagem</label>
            </div>
            <button type="submit" class="btn">Adicionar Aviso</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
