<?php
require_once "../conexao.php";
$conexao = conectar();

// Verifica a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->coneect_error);
}

// Verifica se o parâmetro ID foi passado
if(isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    // Query para selecionar os dados do usuário pelo ID
    $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        // Loop pelos resultados e atribui às variáveis PHP
        while($row = $result->fetch_assoc()) {
            $nome = $row['nome'];
            $email = $row['email'];
            $senha = $row['senha']; // Note que não é recomendado armazenar senhas em texto simples em bancos de dados reais!
            $datas = $row['data_nascimento'];
            $status = $row['categoria']; // Ajuste conforme o nome correto do campo
            $CPF = $row['CPF'];
            $RG = $row['RG'];
            $categoria = $row['nivel'];
            $telefone = $row['telefone'];
            $endereco = $row['endereco'];
            $responsavel = $row['responsavel'];
            $data_entrada = $row['data_entrada'];
            $tele_respon = $row['telefone_responsavel'];
            $idade = $row['idade'];
            $nom_dan = $row['nome_dancarino'];
            $genero = $row['sexo']; // Ajuste conforme o nome correto do campo
        }
    } else {
        echo "Nenhum resultado encontrado para o ID especificado.";
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    echo "ID de usuário não especificado.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" href="formulario/img/cadastro.png">
    <link rel="stylesheet" href="css/style2.css">
    <title>Edição</title>
</head>

<body>
    <div class="container">
        <header>
            <img src="../img/icno.jpg" alt="Logo" class="logo" />
        </header>
        <h1> Atualização do Usuário </h1>
        <form class="form" action="codigo/formEdit.php" method="GET" enctype="multipart/form-data">

            <div class="form_grupo">
                <label for="nome" class="form_label">ID</label>
                <input type="text" name="id_usuario" class="form_input"
                    value="<?php echo isset($id_usuario) ? $id_usuario : ''; ?>" placeholder="ID">
            </div>
            <div class="form_grupo">
                <label for="nome" class="form_label">Nome</label>
                <input type="text" name="nome" class="form_input" value="<?php echo isset($nome) ? $nome : ''; ?>"
                    placeholder="Nome">
            </div>
            <div class="form_grupo">
                <label for="email" class="form_label">Email</label>
                <input type="email" name="email" class="form_input" value="<?php echo isset($email) ? $email : ''; ?>"
                    placeholder="seuemail@email.com">
            </div>
            <div class="form_grupo">
                <label for="senha" class="form_label">Senha</label>
                <input type="password" name="senha" class="form_input"
                    value="<?php echo isset($senha) ? $senha : ''; ?>" placeholder="mínimo 8 caracteres">
            </div>
            <div class="form_grupo">
                <label for="datas" class="form_label">Data de Nascimento</label>
                <input type="date" name="datas" class="form_input" value="<?php echo isset($datas) ? $datas : ''; ?>"
                    placeholder="Data de Nascimento">
            </div>
            <div class="form_grupo">
                <label for="status" class="text">Categoria</label>
                <select name="status" class="dropdown">
                    <option value="" disabled <?php echo ($status == '') ? 'selected' : ''; ?>>Selecione</option>
                    <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Dançarino</option>
                    <option value="2" <?php echo ($status == 2) ? 'selected' : ''; ?>>Coordenador</option>
                    <option value="3" <?php echo ($status == 3) ? 'selected' : ''; ?>>Responsável</option>
                </select>
            </div>
            <div class="form_grupo">
                <label for="CPF" class="form_label">CPF</label>
                <input type="text" name="CPF" class="form_input" value="<?php echo isset($CPF) ? $CPF : ''; ?>"
                    placeholder="00000000000">
            </div>
            <div class="form_grupo">
                <label for="RG" class="form_label">RG</label>
                <input type="text" name="RG" class="form_input" value="<?php echo isset($RG) ? $RG : ''; ?>"
                    placeholder="00000000000">
            </div>
            <div class="form_grupo">
                <label for="categoria" class="form_label">Nível</label>
                <input type="text" name="categoria" class="form_input"
                    value="<?php echo isset($categoria) ? $categoria : ''; ?>" placeholder="adulto, juvenil, mirim">
            </div>
            <div class="form_grupo">
                <label for="telefone" class="form_label">Telefone</label>
                <input type="text" name="telefone" class="form_input"
                    value="<?php echo isset($telefone) ? $telefone : ''; ?>" placeholder="(00)0000-00000">
            </div>
            <div class="form_grupo">
                <label for="endereco" class="form_label">Endereço</label>
                <input type="text" name="endereco" class="form_input"
                    value="<?php echo isset($endereco) ? $endereco : ''; ?>" placeholder="">
            </div>
            <div class="form_grupo">
                <label for="responsavel" class="form_label">Responsável</label>
                <input type="text" name="responsavel" class="form_input"
                    value="<?php echo isset($responsavel) ? $responsavel : ''; ?>" placeholder="Nome">
            </div>
            <div class="form_grupo">
                <label for="data_entrada" class="form_label">Data de Entrada</label>
                <input type="date" name="data_entrada" class="form_input"
                    value="<?php echo isset($data_entrada) ? $data_entrada : ''; ?>" placeholder="">
            </div>
            <div class="form_grupo">
                <label for="tele_respon" class="form_label">Telefone do Responsável</label>
                <input type="text" name="tele_respon" class="form_input"
                    value="<?php echo isset($tele_respon) ? $tele_respon : ''; ?>" placeholder="(00)0000-00000">
            </div>
            <div class="form_grupo">
                <label for="idade" class="form_label">Idade</label>
                <input type="text" name="idade" class="form_input" value="<?php echo isset($idade) ? $idade : ''; ?>"
                    placeholder="">
            </div>
            <div class="form_grupo">
                <label for="nom_dan" class="form_label">Nome do Dançarino</label>
                <input type="text" name="nom_dan" class="form_input"
                    value="<?php echo isset($nom_dan) ? $nom_dan : ''; ?>" placeholder="">
            </div>
            <div class="form_grupo">
                <label for="genero" class="text">Sexo</label>
                <select name="genero" class="dropdown">
                    <option value="" disabled <?php echo ($genero == '') ? 'selected' : ''; ?>>Selecione</option>
                    <option value="M" <?php echo ($genero == 'M') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="F" <?php echo ($genero == 'F') ? 'selected' : ''; ?>>Feminino</option>
                </select>
            </div>
            <br>


            <button type="submit" name="Submit" class="form-control">Atualizar</button>
            <a href="../index.php" class="form-control">Voltar</a>


        </form>
</body>

</html>