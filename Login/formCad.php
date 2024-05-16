<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" href="../img/img/cadastro.png">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">



    <title>Cadastro</title>

</head>

<body>

    <header class="main_header container">
        <div class="content">

            <div class="main_header_logo">
                <img src="../img/icno.jpg" alt="logo.jpg" />
            </div>

        </div>
    </header>



    <main class="main_content container">


        <section class="section-seu-codigo container">

            <div class="content">

                <div class="box-artigo">


                    <!--Inícia Formulário-->

                    
                    <div class="container_form">

                        <h1>Formulário de Cadastro do Usuário </h1>

                        <form class="form" action="cadastrar.php" method="POST" enctype="multipart/form-data">

                            <div class="form_grupo">
                                <label for="nome" class="form_label">Nome</label>
                                <input type="text" name="usuario" class="form_input" 
                                    placeholder="Nome" required>
                            </div>

                            <div class="form_grupo">
                                <label for="e-mail" class="form_label">Email</label>
                                <input type="email" name="email" class="form_input" placeholder="seuemail@email.com"
                                    required>
                            </div>

                            <div class="form_grupo">
                                <label for="senha" class="form_label">Senha</label>
                                <input type="password" name="senha" class="form_input" placeholder="minimo 8 caracteres"
                                    required>
                            </div>

                            <div class="form_grupo">
                                <label for="datanascimento" class="form_label">Data de Nascimento</label>
                                <input type="date" name="datas" class="form_input" placeholder="Data de Nascimento"
                                    required>
                            </div>

                            <div class="form_grupo">

                                <label for="status" class="form_label" class="text">Categoria</label>
                                <select name="status" class="dropdown" required>

                                    <option selected disabled class="form_select_option" value="">Selecione</option>
                                    <option value="1" class="form_select_option">Dançarino</option>
                                    <option value="2" class="form_select_option">Coordenador </option>
                                    <option value="3" class="form_select_option">Responsável</option>


                                </select>

                            </div>


                            <div class="form_grupo">
                                <label for="CPF" class="form_label">CPF</label>
                                <input type="text" name="CPF" class="form_input" placeholder="00000000000" required>
                            </div>

                            <div class="form_grupo">
                                <label for="RG" class="form_label">RG</label>
                                <input type="text" name="RG" class="form_input" placeholder="00000000000" required>
                            </div>

                            <div class="form_grupo">
                                <label for="Categoria" class="form_label">Nivel</label>
                                <input type="text" name="categoria" class="form_input"
                                    placeholder="adulto,juvenil,mirim" required>
                            </div>

                            <div class="form_grupo">
                                <label for="Telefone" class="form_label">Telefone</label>
                                <input type="text" name="telefone" class="form_input" placeholder="(00)0000-00000"
                                    required>
                            </div>



                            <div class="form_grupo">
                                <label for="endereco" class="form_label">Endereço</label>
                                <input type="text" name="endereco" class="form_input" placeholder="Rua..." required>
                            </div>

                            <div class="form_grupo">
                                <label for="responsavel" class="form_label">Responsável</label>
                                <input type="text" name="responsavel" class="form_input" placeholder="Nome">
                            </div>

                            <div class="form_grupo">
                                <label for="data_entrada" class="form_label">Data de Entrada</label>
                                <input type="date" name="data_entrada" class="form_input" placeholder="" required>
                            </div>

                            <div class="form_grupo">
                                <label for="tele_respon" class="form_label">Telefone do Responsável</label>
                                <input type="text" name="tele_respon" class="form_input" placeholder="(00)0000-00000">
                            </div>

                            <div class="form_grupo">
                                <label for="idade" class="form_label">Idade</label>
                                <input type="text" name="idade" class="form_input" placeholder="" required>
                            </div>

                            <div class="form_grupo">
                                <label for="nom_dan" class="form_label">Nome do Dançarino</label>
                                <input type="text" name="nom_dan" class="form_input" placeholder="">
                            </div>



                            <div class="form_grupo">

                                <label for="genero" class="form_label" class="text">Sexo</label>
                                <select name="genero" class="dropdown" required>

                                    <option selected disabled class="form_select_option" value="" required>Selecione
                                    </option>
                                    <option value="M" class="form_select_option">Masculino</option>
                                    <option value="F" class="form_select_option">Feminino </option>


                                </select>

                            </div>


                            <br>

                            <div class="form_grupo">
                                <label for="arquivo" class="form_label">Imagem</label>
                                <input type="file" name="arquivo" class="form_input" placeholder="">
                            </div>




                      

                               
                                <button type="submit" name="Submit" class="submit_btn">Cadastrar</button>
                                <a href="../index.php" class="submit_btn">VOLTAR</a>

                            </div>
                        </form>

                    </div><!--container_form-->

                


                </div><!--Box Artigo-->


                <div class="clear"></div>
            </div>
        </section><!--FECHA BOX HTML-->


    </main>



    <script src="JavaScript/jquery.js"></script>
    <script src="JavaScript/script.js"></script>

</body>

</html>