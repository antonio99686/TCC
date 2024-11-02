<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Carregamento</title>
    <style>
        /* Estilos do contêiner de carregamento */
        body, html {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #333;
            overflow: hidden;
        }

        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Estilos do círculo animado */
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.2);
            border-top: 5px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 10px;
        }

        /* Texto de carregamento */
        .loading-text {
            font-size: 1.2em;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        /* Animação de rotação */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .spinner {
                width: 40px;
                height: 40px;
                border-width: 4px;
            }
            .loading-text {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            .spinner {
                width: 30px;
                height: 30px;
                border-width: 3px;
            }
            .loading-text {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <div class="spinner"></div>
        <div class="loading-text">Carregando...</div>
    </div>
</body>
</html>
