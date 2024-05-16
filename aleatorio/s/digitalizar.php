<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    // Caminho onde a imagem será salva
    $caminhoSalvo = 'img/';

    // Nome do arquivo e caminho completo
    $nomeArquivo = basename($_FILES["imagem"]["name"]);
    $caminhoCompleto = $caminhoSalvo . $nomeArquivo;

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoCompleto)) {
        // Carrega a imagem original
        $imagem = imagecreatefromjpeg($caminhoCompleto);

        // Obtém as dimensões da imagem
        $largura = imagesx($imagem);
        $altura = imagesy($imagem);

        // Itera sobre os pixels da imagem
        for ($x = 0; $x < $largura; $x++) {
            for ($y = 0; $y < $altura; $y++) {
                // Obtém a cor do pixel na posição (x, y)
                $corOriginal = imagecolorat($imagem, $x, $y);

                // Separa os componentes de cor RGB
                $r = ($corOriginal >> 16) & 0xFF;
                $g = ($corOriginal >> 8) & 0xFF;
                $b = $corOriginal & 0xFF;

                // Converte a cor para tons de cinza
                $gray = round(($r + $g + $b) / 3);

                // Nova cor para o pixel
                $novaCor = imagecolorallocate($imagem, $gray, $gray, $gray);

                // Define a nova cor para o pixel
                imagesetpixel($imagem, $x, $y, $novaCor);
            }
        }

        // Salva a imagem digitalizada
        imagejpeg($imagem, $caminhoSalvo . 'imagem_digitalizada.jpg');

        // Libera a memória
        imagedestroy($imagem);

        echo "Imagem digitalizada com sucesso!";
    } else {
        echo "Falha ao fazer o upload da imagem.";
    }
} else {
    echo "Por favor, selecione uma imagem para digitalizar.";
}
?>
