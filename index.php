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
    <!-- Inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.7-beta.16/jquery.inputmask.min.js"></script>
    <title>LOGIN</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <div class="social-icons">
                    <img src="img/icno.jpg" alt="login form" height="150px" width="120px" />
                </div>
                <h1>Criar uma conta</h1>
                <p>Acesse esse link e se cadastre</p>
                <a href="login/formCad.php" target="_blank">Clique aqui!</a>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="login.php" method="POST">
                <div class="social-icons">
                    <img src="img/icno.jpg" alt="login form" height="160px" width="120px">
                </div>
                <h1>Entrar</h1>
                <input type="text" name="CPF" placeholder="Digite seu CPF" required>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
                <p style="color: #333; margin-top: 10px; cursor: pointer;" onclick="showContactCoordinator()">Esqueceu sua senha?</p>
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
    </div>

    <script src="login/script.js"></script>

    <script>

        // Função para mostrar a mensagem de contato com o coordenador
        function showContactCoordinator() {
            Swal.fire({
                icon: 'info',
                title: 'Esqueceu sua senha? ',
                text: 'Por favor, entre em contato com o coordenador para redefinir sua senha.'
            });
        }
    </script>
</body>

</html>
