<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="shortcut icon" href="img/img/icon.png">
    <link rel="stylesheet" href="login/style.css">
    <!--  SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>LOGIN</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <div class="social-icons">
                    <img src="img/icno.jpg" alt="login form" height="150px" width="120px"/>
                </div>
                <h1>Criar uma conta</h1>
                <p>Aceese esse Link e se Cadastre </p>
                <a href="login/formCad.php" target="_blank">Click, Aqui!</a>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="login.php" method="POST">
                <div class="social-icons">
                    <img src="img/icno.jpg" alt="login form" height="150px" width="120px"/>
                </div>
                <h1>Entrar</h1>
                <input type="text" name="CPF" placeholder="CPF" required>
                <input type="password" name="senha" placeholder="SENHA" required>
                <!-- Alteração aqui: adicionando um evento onclick -->
                <p style="color: #333; margin-top: 10px; cursor: pointer;" onclick="showContactCoordinator()">Esqueceu sua senha?</p>
                <button>Entrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem vindo de volta!</h1>
                    <p>Insira seus dados pessoais para usar os recursos do Serviço</p>
                    <button class="hidden" id="login">Entrar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Olá amigo!</h1>
                    <p>Registre-se com seus dados pessoais para usar os recursos do Serviço</p>
                    <button class="hidden" id="register">Cadastre-se</button>
                </div>
            </div>
        </div>
    </div>

    <script src="login/script.js"></script>
    
    <script>
        // Função para verificar se os campos CPF e senha estão preenchidos
function checkFields() {
    var cpf = document.getElementsByName("CPF")[0].value;
    var senha = document.getElementsByName("senha")[0].value;

    // Habilitar ou desabilitar o botão dependendo do estado dos campos
    if (cpf.trim() !== "" && senha.trim() !== "") {
        document.getElementById("loginButton").disabled = false;
        document.getElementById("loginButton").classList.add("enabled");
    } else {
        document.getElementById("loginButton").disabled = true;
        document.getElementById("loginButton").classList.remove("enabled");
    }
}

// Adicionar evento de clique para mostrar a mensagem de contato com o coordenador
function showContactCoordinator() {
    Swal.fire({
        icon: 'info',
        title: 'Esqueceu sua senha?',
        text: 'Por favor, entre em contato com o coordenador para redefinir sua senha.'
    });
}

// Adicionar evento de entrada para verificar os campos CPF e senha
document.getElementsByName("CPF")[0].addEventListener("input", checkFields);
document.getElementsByName("senha")[0].addEventListener("input", checkFields);

    </script>
</body>

</html>
