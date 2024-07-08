<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit.css">
    <script src="../java/login.js" defer></script>
    
    <title>Sentinela da Fronteira</title>
</head>
<body>

<header>
        <h1>Sentinela da Fronteira</h1>
</header>

 
<div class="cadastro">
  <h1> Editar</h1>
<form action="edit  .php" method="POST">
        <p><label class="login__label">
            <span>Nome</span>
            <input type="text" name="username" class="input">
          </label></p>
<br>
        <p><label class="login__label">
            <span>E-mail</span>
            <input type="email" name="email" class="input">
          </label></p>     
 <br>
        <p><label class="login__label">
            <span>Matricula</span>
            <input type="text" name="mat" class="input">
          </label></p>
<br>
        <p><label class="login__label">
            <span>Telefone</span>
            <input type="text" name="tele" class="input">
          </label></p>
<br>
        <p><label class="login__label">
            <span>Entrada</span>
            <input type="date" name="entrada" class="input">
          </label></p> 
<br>  
          <input type="file" name="arquivo"> 
          <br>
           
          <button type="submit" class="login__button" disabled>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                      d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z" />
                  </svg>
                </button>
</form>

</div>




    
    <footer>
        <h3> Sentinela da Fronteira</h3>
    </footer>

    <div class="form-grupo">
                    <label for="datanascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="datas" class="form-input" required />
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
                    <input type="text" name="CPF" class="form-input" placeholder="00000000000" required />
                    <span class="validation-message"></span>
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
                        <option selected disabled class="form-select-option" value="">Selecione</option>
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
                <h2>Carteira de Identidade</h2>
                <div class="form-grupo">
                    <label for="frente" class="form-label">Frente</label>
                    <input type="file" name="frente" class="form-input" required />
                    <span class="validation-message"></span>
                </div>
                <div class="form-grupo">
                    <label for="verso" class="form-label">Verso</label>
                    <input type="file" name="verso" class="form-input" required />
                    <span class="validation-message"></span>
                </div>
</body>
</html>
