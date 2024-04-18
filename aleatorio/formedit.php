<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login_index.css">
    <link rel="shortcut icon" href="img/logo.png">
    <title>sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3>Editar</h3>
                        </div>
                        <div class="card-body">
                            <form action="edit.php" method="POST" enctype="multipart/form-data">
                        <div>
                        <div class="mb-3">
                            <label>Nome completo</label>
                            <input type="text" name="usuario"
                             class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label>Senha</label>
                            <input type="password" name="senha" 
                            class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label>E-mail</label>
                            <input type="email" name="email" 
                            class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label>Data de Nascimento</label>
                            <input type="text" name="nascimento" 
                            class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label>CPF</label>
                            <input type="text" required name="cpf" 
                            class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label>RG</label>
                            <input type="text" required name="RG" 
                            class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label>Categoria</label>
                            <input type="text" name="tipo" 
                            class="form-control">
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <label>Telefone</label>
                            <input type="text" name="telefone" 
                            class="form-control">
                        </div>
                    </div>

                    <div>
                        <div class="mb-3">
                            <label>Imagem</label>
                         <input name="arquivo" type="file" 
                            class="form-control">
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-3">
                            <input type="hidden" name="id">
                            <button type="submit" class="btn 
       btn-primary"> Enviar </button>


                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


</body>

</html>
