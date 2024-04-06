<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <title>Formulário</title>
</head>

<body>
<nav class="menu-lateral">
    <div class="btn-expandir">
        <i class="bi bi-list" id="btn-exp"></i>
    </div>
    <!--btn-expandir-->

    <ul>
        <li class="item-menu ativo">
            <a href="#">
                <span class="icon"><i class="bi bi-house-door"></i></span>
                <span class="txt-link">Home</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="#">
                <span class="icon"><i class="bi bi-clipboard"></i></span>
                <span class="txt-link">Cadastrar</span>
            </a>
            <!-- Submenu -->
            <ul class="submenu">
            <li><a href="form/formcadD.php">Dançarino</a></li>
            <li><a href="form/formcadC.php">Coordenador</a></li>
            <li><a href="form/formcadP.php">Responsavel</a></li>
            </ul>
        </li>
        <li class="item-menu">
            <a href="#">
                <span class="icon"><i class="bi bi-pencil-square"></i></span>
                <span class="txt-link">Editar</span>
            </a>
            <!-- Submenu -->
            <ul class="submenu">
                <li><a href="formedit/formeditD.php">Dançarino</a></li>
                <li><a href="formedit/formeditC.php">Coordenador</a></li>
                <li><a href="formedit/formeditP.php">Responsavel</a></li>
            </ul>
        </li>
        <li class="item-menu">
            <a href="calen/index.php">
                <span class="icon"><i class="bi bi-calendar3"></i></span>
                <span class="txt-link">Agenda</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="#">
                <span class="icon"><i class="bi bi-person-circle"></i></span>
                <span class="txt-link">Conta</span>
            </a>
            <!-- Submenu -->
           
        </li>
    </ul>
</nav><!--menu-lateral-->
    <div class="container">
       
        <div class="form">
        <form action="../editar/formeditC.php" method="POST" enctype="multipart/form-data">
                <div class="form-header">
                    <div class="title">
                        <h1>Editar o Coordenador</h1>
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
                        <label >Telefone</label>
                        <input  type="text" name="telefone" required>
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
                        <label >Endereço</label>
                        <input  type="text" name="endereco"  required>
                    </div>
                    
                    <div class="input-box">
                        <label >Data de Entrada</label>
                        <input  type="date" name="inicio"  required>
                    </div>

                    <div class="input-box">
                        <label >Função</label>
                        <input  type="text" name="funcao"  required>
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

                   
    
                    <input  type="file" name="arquivo" >
               
                    

                </div>

                

                <div class="continue-button">
                    <button type="submit">Enviar </button>
                </div>
            </form>
        </div>
    </div>

    <script src="../..  /java/dash.js"></script>

</body>
</html>