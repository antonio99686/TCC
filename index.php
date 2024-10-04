<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="shortcut icon" href="img/img/icon.png">
    <link rel="stylesheet" href="login/style.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>LOGIN</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form action="login.php" method="GET">
                <div class="social-icons">
                    <img src="img/icno.jpg" alt="login form" height="160px" width="120px">
                </div>
                <h1>Entrar</h1>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                <input type="text" name="CPF" maxlength="14" placeholder="Digite seu CPF" required>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required> <img id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
                <p style="color: #333; margin-top: 10px; cursor: pointer;" onclick="showContactCoordinator()">Esqueceusua senha?</p>
                <button type="submit">Entrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem Vindo de Volta!</h1>
                    <p>Insira seus dados pessoais para usar os recursos</p>
                    <button class="hidden" id="login">Entrar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Sentinela da Fronteira</h1>
                    <p>Registre-se com seus dados pessoais para usar os recursos</p>
                    <button class="hidden" id="register">Cadastre-se</button>
                </div>
            </div>
        </div>
        <div class="form-container sign-up">
            <form id="registrationForm" novalidate action="login/cadastrar.php" method="POST"
                enctype="multipart/form-data">
                <div class="social-icons">
                    <img src="img/icno.jpg" alt="login form" height="150px" width="120px" />
                </div>
                <h2> Inscrição</h2>
                <div class="form-grupo">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="usuario" class="form-input" placeholder="Nome Completo" required />
                    <span class="validation-message"></span>
                </div>
                <div class="form-grupo">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-input" placeholder="mínimo 8 caracteres" required />
                    <span class="validation-message"></span>
                </div>
                

                <div class="form-grupo">
                    <label for="genero" class="form-label"> Genero </label>
                        <select name="genero" required>
                        <option selected disabled class="form-select-option" value="">
                            Selecione
                        </option>
                        <option value="M" class="form-select-option">Masculino</option>
                        <option value="F" class="form-select-option">Feminino</option>
                    </select>
                    <span class="validation-message"></span>
                </div>
                <div class="form-grupo">
                    <label for="status" class="form-label">Categoria</label>
                    <select name="status" class="dropdown" required>
                        <option selected disabled class="form-select-option" value="">Selecione</option>
                        <option value="1" class="form-select-option">Dançarino</option>
                        <option value="2" class="form-select-option">Coordenador</option>
                        <option value="3" class="form-select-option">Responsável</option>
                    </select>
                    <span class="validation-message"></span>
                </div>
                <div class="form-grupo">
                    <label for="CPF" class="form-label">CPF</label>
                    <input type="text" name="CPF" class="form-input" maxlength="14" placeholder="Somente os N°"
                        required>
                    <span class="validation-message"></span>
                </div>

                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <script src="login/script.js"></script>

    <script>
        // Função para mostrar a mensagem de contato com o coordenador
        function showContactCoordinator() {
            Swal.fire({
                icon: 'info',
                title: 'Esqueceu sua senha?',
                text: 'Por favor, entre em contato com o coordenador para redefinir sua senha.'
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cpfInputs = document.querySelectorAll('input[name="CPF"]');
            cpfInputs.forEach(function(input) {
                input.addEventListener("input", function(e) {
                    var value = e.target.value.replace(/\D/g, "");
                    if (value.length > 11) value = value.slice(0, 11);
                    var formattedValue = value;
                    if (value.length > 9) {
                        formattedValue = value.slice(0, 3) + '.' + value.slice(3, 6) + '.' + value.slice(6, 9) + '-' + value.slice(9, 11);
                    } else if (value.length > 6) {
                        formattedValue = value.slice(0, 3) + '.' + value.slice(3, 6) + '.' + value.slice(6);
                    } else if (value.length > 3) {
                        formattedValue = value.slice(0, 3) + '.' + value.slice(3);
                    }
                    e.target.value = formattedValue;
                });
            });
        });
    </script>
    <script>
        var senha = $('#senha');
        var olho = $("#olho");

        olho.mousedown(function() {
            senha.attr("type", "text");
        });

        olho.mouseup(function() {
            senha.attr("type", "password");
        });
   
      
        $("#olho").mouseout(function() {
            $("#senha").attr("type", "password");
        });
    </script>

</body>

</html>