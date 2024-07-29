<?php
session_start();
require_once "../../conexao.php";
$conexao = conectar();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do comprovante da URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Prepara a consulta para obter o caminho do arquivo
    $sql = "SELECT comprovante FROM mensalidades WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $mensalidade = $resultado->fetch_assoc();

    if ($mensalidade && $mensalidade['comprovante']) {
        $filePath = 'img/' . $mensalidade['comprovante'];
        
        if (file_exists($filePath)) {
            // Força o download do arquivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            flush(); //(Flush -> Buffer) de saída do sistema de descarga
            readfile($filePath);
            exit();
        } else {
            http_response_code(404);
            echo "Arquivo não encontrado.";
        }
    } else {
        http_response_code(404);
        echo "Comprovante não encontrado.";
    }
} else {
    http_response_code(400);
    echo "ID inválido.";
}
?>
