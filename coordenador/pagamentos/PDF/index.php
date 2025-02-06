<?php
// Verifica se o mês foi enviado via GET
if (isset($_GET['mes_selecionado']) && !empty($_GET['mes_selecionado'])) {
    $mes_selecionado = $_GET['mes_selecionado'];
} else {
    die("Mês não selecionado.");
}

// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";
$conexao = conectar();

// Consulta para buscar os registros do mês selecionado
$sql = "
    SELECT m.mes, m.pago, m.comprovante, u.nome 
    FROM mensalidades AS m
    JOIN usuario AS u ON m.usuario_id = u.id_usuario
    WHERE m.mes = '$mes_selecionado'
";
$result = $conexao->query($sql);

// Verifica se há registros para o mês selecionado
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
            h1, h2 {
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
        <h2>Mês: " . date("F Y", strtotime($mes_selecionado)) . "</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Mês</th>
                    <th>Pago</th>
                    <th>Comprovante</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>";
    
    // Itera pelos registros e adiciona ao HTML
    while ($row = $result->fetch_assoc()) {
        $mes = date("F Y", strtotime($row['mes'])); // Converte o mês para formato legível
        $pago = $row['pago'] ? "Sim" : "Não"; // Mostra "Sim" para 1 e "Não" para 0
        $comprovante = !empty($row['comprovante']) ? "Anexado" : "Não anexado";

        $html .= "
            <tr>
                <td>{$row['nome']}</td>
                <td>{$mes}</td>
                <td>{$pago}</td>
                <td>{$comprovante}</td>
                <td>R$ 30,00</td>
            </tr>";
    }

    $html .= "
            </tbody>
        </table>
    </body>
    </html>";
} else {
    $html = "<h1>Não há registros para o mês selecionado.</h1>";
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
$dompdf->stream("relatorio_mensalidades_{$mes_selecionado}.pdf", ["Attachment" => true]);

// Fecha a conexão com o banco de dados
$conexao->close();
?>
