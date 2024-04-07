<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="stylesheet" href="">
    <title>Formulário</title>
</head>

<body>
    <div class="container">
       
        <div class="form">
        <form action="../editar/formeditP.php" method="POST" enctype="multipart/form-data">
                <div class="form-header">
                    <div class="title">
                        <h1>Editar o Responsável </h1>
                    </div>
                    
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label >Nome</label>
                        <input  type="text" name="usuario"  required>
                    </div>

                    <div class="input-box">
                        <label >Nome do Filho(a)</label>
                        <input  type="text" name="nome"  required>
                    </div>

                    <div class="input-box">
                        <label >Senha</label>
                        <input  type="password" name="senha"  required>
                    </div>
                    <div class="input-box">
                        <label >E-mail</label>
                        <input  type="email" name="email" required>
                    </div>

                    <div class="input-box">
                        <label >telefone</label>
                        <input  type="text" name="telefone" required>
                    </div>


                    <div class="input-box">
                        <label >CPF</label>
                        <input  type="text" name="cpf"  required>
                    </div>
                   
                    <div class="input-box">
                        <label >Idade</label>
                        <input  type="text" name="idade"  required>
                    </div>

                    <div class="input-box">
                        <label >Municipio</label>
                        <input  type="text" name="nas"  required>
                    </div>
                    <div class="input-box">
                        <label >Função</label>
                        <input  type="text" name="funcao"  required>
                    </div>

                    <input  type="file" name="arquivo" >
                 
                  
                    
               

                   
                   
                </div>

                

                <div class="continue-button">
                    <button type="submit">Enviar </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>