<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exemplo de Caixas de Mensagem</title>
  <!-- Adicionando Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <!-- Botão para acionar a caixa de sucesso -->
    <button class="btn btn-primary" onclick="mostrarSucesso()">Mostrar Sucesso</button>
    <!-- Botão para acionar a caixa de erro -->
    <button class="btn btn-danger mx-2" onclick="mostrarErro()">Mostrar Erro</button>

    <!-- Caixa de mensagem de sucesso (invisível por padrão) -->
    <div class="alert alert-success mt-3" role="alert" id="caixaSucesso" style="display: none;">
      Cadastro realizado com sucesso!
    </div>

    <!-- Caixa de mensagem de erro (invisível por padrão) -->
    <div class="alert alert-danger mt-3" role="alert" id="caixaErro" style="display: none;">
      Ocorreu um erro no cadastro. Por favor, tente novamente.
    </div>
  </div>

  <!-- Adicionando Bootstrap JS (opcional, apenas se necessário) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Função para mostrar caixa de sucesso
    function mostrarSucesso() {
      // Mostrar a caixa de sucesso
      document.getElementById('caixaSucesso').style.display = 'block';
      // Esconder a caixa de erro (se estiver visível)
      document.getElementById('caixaErro').style.display = 'none';
    }

    // Função para mostrar caixa de erro
    function mostrarErro() {
      // Mostrar a caixa de erro
      document.getElementById('caixaErro').style.display = 'block';
      // Esconder a caixa de sucesso (se estiver visível)
      document.getElementById('caixaSucesso').style.display = 'none';
    }
  </script>
</body>
</html>
