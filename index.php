<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="shortcut icon" href="img/img/icon.png">
    <link rel="stylesheet" href="login/style.css">
    <link rel="stylesheet" href="login/css/inscricao.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>LOGIN</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form action="login.php" method="POST">
                <div class="social-icons">
                    <img src="img/icno.jpg" alt="login form" height="160px" width="120px">
                </div>
                <h1>Entrar</h1>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                <input type="text" name="CPF" maxlength="14" placeholder="Digite seu CPF" required>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required> <img id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
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
                <div class="form-group">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senhass" name="senha" class="form-input" placeholder="Digite sua Senha" required>
                    <span class="validation-message" style="color: red;"></span> <!-- Mensagem de erro -->
                </div>
                <div class="form-group">
                    <label for="senha" class="form-label">Repita</label>
                    <input type="password" name="senha" class="form-input" placeholder="Repite a senha" required>
                    <span class="validation-message" style="color: red;"></span> <!-- Mensagem de erro -->
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
                <div class="form-group">
                    <label for="CPF" class="form-label">CPF</label>
                    <input type="text" name="CPF" class="form-input" maxlength="14" placeholder="Somente os N°" required>
                    <span class="validation-message" style="color: red;"></span> <!-- Mensagem de erro -->
                </div>

                <div class="form-group">
                    <label for="CPF" class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="Email" required>
                    <span class="validation-message" style="color: red;"></span> <!-- Mensagem de erro -->
                </div>

                <div class="form-grupo">
                    <label for="RG" class="form-label">RG</label>
                    <input type="text" name="RG" class="form-input" placeholder="00000000000" required />
                    <span class="validation-message"></span>
                </div>

                <div class="form-grupo">
                    <label for="Categoria" class="form-label">Nível</label>
                    <input type="text" name="categoria" class="form-input" placeholder="adulto, juvenil, mirim" required />
                    <span class="validation-message"></span>
                </div>

                <div class="form-grupo">
                    <label for="Telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" class="form-input" placeholder="(00) 0000-0000" required />
                    <span class="validation-message"></span>
                </div>

                <div class="form-grupo">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" name="endereco" class="form-input" placeholder="Rua..." required />
                    <span class="validation-message"></span>
                </div>

                <div class="form-grupo">
                    <label for="responsavel" class="form-label">Responsável</label>
                    <input type="text" name="responsavel" class="form-input" placeholder="Nome" />
                    <span class="validation-message"></span>
                </div>

                <div class="form-grupo">
                    <label for="data_entrada" class="form-label">Data de Entrada</label>
                    <input type="date" name="data_entrada" class="form-input" required />
                    <span class="validation-message"></span>
                </div>

                <div class="form-grupo">
                    <label for="tele_respon" class="form-label">Telefone do Responsável</label>
                    <input type="text" name="tele_respon" class="form-input" placeholder="(00) 0000-0000" />
                    <span class="validation-message"></span>
                </div>

                <div class="form-grupo">
                    <label for="idade" class="form-label">Idade</label>
                    <input type="text" name="idade" class="form-input" required />
                    <span class="validation-message"></span>
                </div>

                <div class="form-grupo">
                    <label for="nom_dan" class="form-label">Nome do Dançarino</label>
                    <input type="text" name="nom_dan" class="form-input" />
                    <span class="validation-message"></span>
                </div>


                <div class="form-grupo">
                    <label for="avatar-image" class="custom-file-button">Selecionar Foto de Perfil</label>
                    <p id="file-help" style="top: -65px; position: relative;">Escolha uma imagem </p>
                    <input type="file"  name="file" class="file" aria-describedby="file-help" >

                </div>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <script src="login/script.js"></script>

    <script>
        // Função para mostrar a mensagem de contato com o coordenador
        async function showContactCoordinator() {
            const {
                value: email
            } = await Swal.fire({
                title: "Insira o endereço de e-mail",
                input: "email",
                inputLabel: "Seu endereço de email",
                inputPlaceholder: "Digite seu endereço de e-mail",
                inputValidator: (value) => {
                    if (!value) {
                        return 'Você precisa inserir um e-mail válido!';
                    }
                }
            });
            if (email) {
                // Redireciona para um novo formulário com o e-mail como parâmetro na URL
                window.location.href = `recuperar_/recuperar.php?email=${encodeURIComponent(email)}`;
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cpfInputs = document.querySelectorAll('input[name="CPF"]');
            cpfInputs.forEach(function(input) {
                input.addEventListener("input", function(e) {
                    var value = e.target.value.replace(/\D/g, ""); // Remove caracteres não numéricos
                    if (value.length > 11) value = value.slice(0, 11); // Limita o CPF a 11 dígitos
                    var formattedValue = value;

                    // Formata o CPF conforme o número de dígitos
                    if (value.length > 9) {
                        formattedValue = value.slice(0, 3) + '.' + value.slice(3, 6) + '.' + value.slice(6, 9) + '-' + value.slice(9, 11);
                    } else if (value.length > 6) {
                        formattedValue = value.slice(0, 3) + '.' + value.slice(3, 6) + '.' + value.slice(6);
                    } else if (value.length > 3) {
                        formattedValue = value.slice(0, 3) + '.' + value.slice(3);
                    }

                    e.target.value = formattedValue;

                    // Valida o CPF
                    if (value.length === 11 && !validarCPF(value)) {
                        // Exibe a mensagem de erro
                        e.target.nextElementSibling.textContent = "CPF inválido";
                    } else {
                        // Limpa a mensagem de erro se o CPF for válido
                        e.target.nextElementSibling.textContent = "";
                    }
                });
            });
        });

        // Função para validar o CPF
        function validarCPF(cpf) {
            // Elimina CPFs com todos os números iguais (ex: 111.111.111-11)
            if (/^(\d)\1{10}$/.test(cpf)) return false;

            var soma = 0;
            var resto;

            // Validação do primeiro dígito verificador
            for (var i = 1; i <= 9; i++) {
                soma += parseInt(cpf.charAt(i - 1)) * (11 - i);
            }
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(9))) return false;

            soma = 0;

            // Validação do segundo dígito verificador
            for (var i = 1; i <= 10; i++) {
                soma += parseInt(cpf.charAt(i - 1)) * (12 - i);
            }
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(10))) return false;

            return true;
        }
        //Validação de senha com 8 digitos
        document.addEventListener("DOMContentLoaded", function() {
            var senhaInput = document.getElementById('senhass');

            senhaInput.addEventListener("input", function(e) {
                var value = e.target.value;

                // Verifica se a senha tem pelo menos 8 caracteres
                if (value.length < 8) {
                    // Exibe a mensagem de erro
                    e.target.nextElementSibling.textContent = "A senha deve ter pelo menos 8 caracteres.";
                } else {
                    // Limpa a mensagem de erro se a senha for válida
                    e.target.nextElementSibling.textContent = "";
                }
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