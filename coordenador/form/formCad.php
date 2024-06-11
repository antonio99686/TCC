<?php
// Aguarda 1 segundos antes de redirecionar o usuário
sleep(1);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulário de Inscrição</title>
    <link rel="stylesheet" href="formulario/css/style.css" />
    <link rel="shortcut icon" href="formulario/img/cadastro.png">    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container">
        <header>
            <img src="img/icno.jpg" alt="Logo" class="logo" />
        </header>
        <h2>Formulário de Inscrição</h2>
        <form id="registrationForm" novalidate action="codigo/cadastrar.php" method="POST" enctype="multipart/form-data">
            <div class="form-grupo">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="usuario" class="form-input" placeholder="Nome Completo" required />
                <span class="validation-message"></span>
            </div>

            <div class="form-grupo">
                <label for="e-mail" class="form-label">Email</label>
                <input type="email" name="email" class="form-input" placeholder="seuemail@email.com" required />
                <span class="validation-message"></span>
            </div>

            <div class="form-grupo">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-input" placeholder="mínimo 8 caracteres" required />
                <span class="validation-message"></span>
            </div>

            <div class="form-grupo">
                <label for="datanascimento" class="form-label">Data de Nascimento</label>
                <input type="date" name="datas" class="form-input" required />
                <span class="validation-message"></span>
            </div>

            <div class="form-grupo">
                <label for="status" class="form-label">Categoria</label>
                <select name="status" class="dropdown" required>
                    <option selected disabled class="form-select-option" value="">
                        Selecione
                    </option>
                    <option value="1" class="form-select-option">Dançarino</option>
                    <option value="2" class="form-select-option">Coordenador</option>
                    <option value="3" class="form-select-option">Responsável</option>
                </select>
                <span class="validation-message"></span>
            </div>

            <div class="form-grupo">
                <label for="CPF" class="form-label">CPF</label>
                <input type="text" name="CPF" class="form-input" placeholder="00000000000" required />
                <span class="validation-message">Só os números sem pontos e traço.</span>
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
                <label for="genero" class="form-label">Sexo</label>
                <select name="genero" class="dropdown" required>
                    <option selected disabled class="form-select-option" value="">
                        Selecione
                    </option>
                    <option value="M" class="form-select-option">Masculino</option>
                    <option value="F" class="form-select-option">Feminino</option>
                </select>
                <span class="validation-message"></span>
            </div>

            <div class="form-grupo">
                <label for="arquivo" class="form-label">Imagem</label>
                <input type="file" name="arquivo" class="form-input" />
                <span class="validation-message"></span>
            </div>

            <button type="submit">Enviar</button>
        </form>
    </div>
    <script src="JavaScript.js"></script>
</body>

</html>