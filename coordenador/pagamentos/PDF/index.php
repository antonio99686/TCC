<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";
$conexao = conectar();

// Consulta para buscar todos os registros da tabela `mensalidades`
$sql = "SELECT mes, pago, comprovante FROM mensalidades";
$result = $conexao->query($sql);

// Verifica se há registros na tabela
if ($result->num_rows > 0) {
    // Inicia a construção do HTML para o PDF
    $html = "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Relatório de Mensalidades</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            h1 {
                text-align: center;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 10px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>Relatório de Mensalidades</h1>
        <table>
            <thead>
                <tr>
                    <th>Mês</th>
                    <th>Pago</th>
                    <th>Comprovante</th>
                </tr>
            </thead>
            <tbody>";
    
    // Itera pelos registros e adiciona ao HTML
    while ($row = $result->fetch_assoc()) {
        $mes = date("F Y", strtotime($row['mes'])); // Converte o mês para formato legível (ex.: Novembro 2024)
        $pago = $row['pago'] ? "Sim" : "Não"; // Mostra "Sim" para 1 e "Não" para 0
        $comprovante = !empty($row['comprovante']) ? "Anexado" : "Não anexado";

        $html .= "
            <tr>
                <td>{$mes}</td>
                <td>{$pago}</td>
                <td>{$comprovante}</td>
            </tr>";
    }

    $html .= "
            </tbody>
        </table>
    </body>
    </html>";
} else {
    $html = "<h1>Não há registros de mensalidades.</h1>";
}

// Inclui a biblioteca DomPDF
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Inicializa o DomPDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// Define o tamanho e a orientação do papel
$dompdf->setPaper('A4', 'portrait');

// Renderiza o HTML como PDF
$dompdf->render();

// Força o download do arquivo PDF
$dompdf->stream("relatorio_mensalidades.pdf", ["Attachment" => true]);

// Fecha a conexão com o banco de dados
$conexao->close();
?>
