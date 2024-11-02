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
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Verifica se o parâmetro 'id' foi passado e o converte para inteiro

if ($id > 0) { 
    // Prepara a consulta SQL para obter o caminho do arquivo comprovante da tabela 'mensalidades'
    $sql = "SELECT comprovante FROM mensalidades WHERE id = ?";
    $stmt = $conexao->prepare($sql); 
    $stmt->bind_param('i', $id); 
    $stmt->execute(); 
    $resultado = $stmt->get_result(); 
    $mensalidade = $resultado->fetch_assoc(); 

    if ($mensalidade && $mensalidade['comprovante']) { 
        $filePath = 'img/' . $mensalidade['comprovante']; 

        if (file_exists($filePath)) { // Verifica se o arquivo realmente existe no servidor
            // Força o download do arquivo configurando os headers HTTP
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream'); // Define o tipo do conteúdo como binário
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"'); // Configura o nome do arquivo no download
            header('Expires: 0'); // Define a expiração como zero para forçar o download imediato
            header('Cache-Control: must-revalidate'); // Controle de cache para garantir a validação
            header('Pragma: public'); // Define que o conteúdo é público
            header('Content-Length: ' . filesize($filePath)); // Define o tamanho do arquivo para o download
            flush(); // Envia o buffer de saída do sistema para o navegador
            readfile($filePath); // Lê e envia o conteúdo do arquivo para o navegador
            exit(); // Encerra o script após o download
        } else {
            http_response_code(404); // Retorna o código HTTP 404 se o arquivo não for encontrado
            echo "Arquivo não encontrado."; // Exibe mensagem de erro
        }
    } else {
        http_response_code(404); // Retorna 404 se o comprovante não for encontrado no banco
        echo "Comprovante não encontrado."; // Exibe mensagem de erro
    }
} else {
    http_response_code(400); // Retorna o código HTTP 400 se o ID fornecido for inválido
    echo "ID inválido."; // Exibe mensagem de erro
}
?>
