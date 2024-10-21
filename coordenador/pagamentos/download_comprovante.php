<?php
session_start(); // Inicia a sessão
require_once "../../conexao.php"; // Inclui o arquivo de conexão com o banco de dados
$conexao = conectar(); // Conecta ao banco de dados

// Verifica se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php"); // Redireciona para a página de login se o usuário não estiver autenticado
    exit();
}

// Obtém o ID do comprovante da URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Verifica se o parâmetro 'id' foi passado e o converte para inteiro

if ($id > 0) { // Verifica se o ID é válido (maior que 0)
    // Prepara a consulta SQL para obter o caminho do arquivo comprovante da tabela 'mensalidades'
    $sql = "SELECT comprovante FROM mensalidades WHERE id = ?";
    $stmt = $conexao->prepare($sql); // Prepara a consulta SQL
    $stmt->bind_param('i', $id); // Substitui o '?' pelo valor do ID
    $stmt->execute(); // Executa a consulta
    $resultado = $stmt->get_result(); // Obtém o resultado da consulta
    $mensalidade = $resultado->fetch_assoc(); // Obtém os dados da mensalidade

    if ($mensalidade && $mensalidade['comprovante']) { // Verifica se existe um comprovante para o ID fornecido
        $filePath = 'img/' . $mensalidade['comprovante']; // Define o caminho completo do arquivo (a partir da pasta 'img')

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
