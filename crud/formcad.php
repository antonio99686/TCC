<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formcad.css">
    <script src="../java/login.js" defer></script>
    
    <title>Sentinela da Fronteira</title>
</head>
<body>

<header>
        <h1>Sentinela da Fronteira</h1>
</header>

 
<div class="cadastro">
  <h1> Cadastro</h1>
<form action="cadastrar.php" method="POST">
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
            <span>Senha</span>
            <input type="password" name="senha" class="input">
          </label></p>
<br>
        <p><label class="login__label">
            <span>Matricula</span>
            <input type="text" name="matricula" class="input">
          </label></p>
<br>
        <p><label class="login__label">
            <span>Telefone</span>
            <input type="text" name="telefone" class="input">
          </label></p>
<br>
        <p><label class="login__label">
            <span>Entrada</span>
            <input type="date" name="entrada" class="input">
          </label></p> 
<br>  
          <input type="file" name="arquivo"> 
          <br>
           
          <input type="submit" value="cadastrar" >
                  
                </button>
</form>

</div>




    
    <footer>
        <h3> Sentinela da Fronteira</h3>
    </footer>
</body>
</html>
