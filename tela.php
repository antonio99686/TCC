<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Carregamento</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        h2 {
            margin-top: 20px;
            color: #3498db;
        }

        #content {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div id="loading-screen">
        <div class="spinner"></div>
        <h2>Carregando...</h2>
    </div>

    <div id="content" style="display:none;">
        <h1>Conteúdo da Página</h1>
        <p>Esta é a página principal, que será exibida após o carregamento.</p>
    </div>

    <script>
        window.addEventListener('load', function() {
            // Esconde a tela de carregamento após o carregamento completo
            document.getElementById('loading-screen').style.display = 'none';
            // Exibe o conteúdo da página
            document.getElementById('content').style.display = 'block';
        });
    </script>
</body>

</html>