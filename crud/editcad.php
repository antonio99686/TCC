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
</body>
</html>
