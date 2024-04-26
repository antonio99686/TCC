<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de Carregamento</title>
  <!-- Adicionando Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .loader-container {
      text-align: center;
      max-width: 400px;
    }

    .loader {
      border: 8px solid #f3f3f3; /* Cinza claro */
      border-top: 8px solid #3498db; /* azul */
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
      margin: 0 auto 20px; /* Centraliza horizontalmente */
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .loading-text {
      font-size: 1.2rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="loader-container">
          <div class="loader"></div>
          <p class="loading-text">Carregando...</p>
        </div>
      </div>
    </div>
  </div>

  
  <script>
    // Redirecionar para outra página após 3 segundos (3000 milissegundos)
    setTimeout(function() {
      window.location.href = '####';
    }, 3000); // 3 segundos em milissegundos
  </script>
</body>
</html>
