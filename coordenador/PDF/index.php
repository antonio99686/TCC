<?php
// Inclui o arquivo de conexão com o banco de dados
include('conexao.php');

// Obtém o ID do usuário da variável GET na URL
$id_usuario = $_GET['id_usuario']; 

// Cria a consulta SQL para selecionar os dados do usuário com o ID especificado
$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";

// Executa a consulta SQL
$result = $conexao->query($sql);

// Verifica se a consulta retornou resultados
if ($result->num_rows > 0) {

    // Inicia a construção do HTML para o PDF, incluindo os estilos CSS
    $html = "
    <style>
        .header {
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .header img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .header h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .header p {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .table-wrapper {
            margin-top: 20px;
        }
        .responsive-table {
            width: 100%;
            border-collapse: collapse;
        }
        .responsive-table th, .responsive-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
    <div class='header'>
        <img src='img/icno.jpg' alt='Logo'>
        <h2>Sentinela da Fronteira</h2>
        <p>Email: sentinaladafronteira@gmail.com</p>
        <p>Data: " . date('d/m/Y') . "</p>
    </div>
    <div class='table-wrapper'>
        <table class='responsive-table'>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody>";

    // Loop para percorrer os resultados da consulta
    while ($dados = $result->fetch_assoc()) {
        // Adiciona os dados do usuário à tabela HTML
        $html .= "<tr>
                    <td>" . $dados['nome'] . "</td>
                    <td>" . $dados['email'] . "</td>
                    <td>" . $dados['datas'] . "</td>
                    <td>" . $dados['CPF'] . "</td>
                </tr>";
    }

    // Fecha a tabela e as divs
    $html .= "</tbody>
            </table>
        </div>";
} else {
    // Caso não haja resultados, exibe uma mensagem
    $html = 'Nenhum dado registrado';
}

// Carrega a biblioteca Dompdf
use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';

// Inicializa o objeto Dompdf
$PDF = new Dompdf();

// Carrega o HTML gerado para o PDF
$PDF->loadHtml($html);

// Define a fonte padrão
$PDF->set_option('defaultFont', 'Arial');

// Define o tamanho e a orientação do papel
$PDF->setPaper('A4', 'portrait');

// Renderiza o PDF
$PDF->render();

// Exibe o PDF no navegador
$PDF->stream();
?>
