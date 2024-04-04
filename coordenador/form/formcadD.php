<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forms.css">
    <title>Formulário</title>
</head>

<body>
    <div class="container">
       
        <div class="form">
        <form action="../cadastrar/cadastrarD.php" method="POST" enctype="multipart/form-data">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastre o Dançarino </h1>
                    </div>
                    
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label >Nome</label>
                        <input  type="text" name="usuario"  required>
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
                        <label >Data de Nascimento</label>
                        <input  type="date" name="nascimento"  required>
                    </div>

                    <div class="input-box">
                        <label >CPF</label>
                        <input  type="text" name="cpf"  required>
                    </div>
                    <div class="input-box">
                        <label >RG</label>
                        <input  type="text" name="RG"  required>
                    </div>
                    <div class="input-box">
                        <label >Telefone</label>
                        <input  type="text" name="telefone"  required>
                    </div>
                    <div class="input-box">
                        <label >Endereço</label>
                        <input  type="text" name="endereco"  required>
                    </div>
                    <div class="input-box">
                        <label >Responsável</label>
                        <input  type="text" name="responsavel"  required>
                    </div>
                    <div class="input-box">
                        <label >Data de Entrada</label>
                        <input  type="date" name="inicio"  required>
                    </div>
                    <div class="input-box">
                        <label >Telefone do responsável</label>
                        <input  type="text" name="tele_respo"  required>
                    </div>
                    <div class="input-box">
                        <label >Idade</label>
                        <input  type="text" name="idade"  required>
                    </div>
                    
                    
                    <div class="input-box">
                        <label>Genero:</label>
                        <select name="genero">
                            <option value="M"> Masculino </option>
                            <option value="F"> Feminino</option>
                            
                        </select>
                    </div>
                    <div class="input-box">
                        <label>Categoria</label>
                        <select name="tipo">
                            <option value="mirim"> Mirim </option>
                            <option value="juvenil"> Juvenil </option>
                            <option value="adulto"> Adulto </option>
                        </select>
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