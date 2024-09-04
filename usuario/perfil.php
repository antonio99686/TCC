<?php
session_start();
// Aguarda 1 segundos antes de redirecionar o usuário
sleep(1);
require_once "conexao.php";
$conexao = conectar();

// Verifica se a sessão está iniciada e se o usuário está logado
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário utilizando prepared statements para evitar injeção de SQL
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Obtém os dados do usuário
$dados = mysqli_fetch_assoc($resultado);

// Verifica se um arquivo foi enviado via formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = $id_usuario . '.' . $fileExtension;

    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        $uploadFileDir = '../img/perfil/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $updateSql = "UPDATE usuario SET imagem = ? WHERE id_usuario = ?";
            $updateStmt = mysqli_prepare($conexao, $updateSql);
            mysqli_stmt_bind_param($updateStmt, 'si', $newFileName, $id_usuario);
            mysqli_stmt_execute($updateStmt);

            $_SESSION['mensagem'] = 'Imagem atualizada com sucesso!';
            $_SESSION['tipo_mensagem'] = 'success';
            $_SESSION['titulo_mensagem'] = 'Sucesso';
        } else {
            $_SESSION['mensagem'] = 'Erro ao mover o arquivo enviado';
            $_SESSION['tipo_mensagem'] = 'error';
            $_SESSION['titulo_mensagem'] = 'Erro';
        }
    } else {
        $_SESSION['mensagem'] = 'Formato de arquivo não suportado';
        $_SESSION['tipo_mensagem'] = 'error';
        $_SESSION['titulo_mensagem'] = 'Erro';
    }
    header('Location: perfil.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../img/img/icon.png">
    <link rel="stylesheet" href="css/perfil.css">
    <title>Sentinela da fronteira</title>
   </head>

<body>
    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Unindo Forças é <span class="danger">Bem Mais Facíl</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="dashboard.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="participantes">
                    <span class="material-icons-sharp">
                        groups
                    </span>
                    <h3>Users</h3>
                </a>
                <a href="perfil.php" class="active">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Perfil</h3>
                </a>
                <a href="calen" target="_blank">
                    <span class="material-icons-sharp">
                        event
                    </span>
                    <h3>Calendario</h3>
                </a>
                <a href="pagamento">
                    <span class="material-icons-sharp">
                        paid
                    </span>
                    <h3>Pagamento</h3>
                </a>
                <a href="acessorios">
                    <span class="material-icons-sharp">
                        checkroom
                    </span>
                    <h3>Vestimentas</h3>
                </a>
                <a href="logout.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main>
            <h1>Perfil</h1>
            <div class="box">
                <h2>Dados Usuário</h2>
                <br>
                <div class="user"><em><b>Nome:</b></em> <?php echo $dados['nome'] ?></div>
                <br>
                <div class="user1"><em><b>Telefone:</b></em> <?php echo $dados['telefone'] ?></div>
                <br>
                <div class="user2"><em><b>E-mail:</b></em> <?php echo $dados['email'] ?></div>
                <br>
                <div class="user3"><em><b>Senha:</b></em> <?php echo $dados['senha'] ?></div>
                <br>
                <div class="user4"><em><b>CPF:</b></em> <?php echo $dados['CPF'] ?></div>
                <br>
                <div class="user5"><em><b>Idade:</b></em> <?php echo $dados['idade'] ?></div>
                <br>
                <div class="user6"><em><b>Matrícula:</b></em> <?php echo $dados['matricula'] ?></div>
                <br>
                <div class="user7"><em><b>Data de Nascimento:</b></em> <?php echo date('d/m/Y', strtotime($dados['datas'])) ?></div>
                <br>
                <div class="user8"><em><b>RG:</b></em> <?php echo $dados['RG'] ?></div>
                <br>
                <div class="user9"><em><b>Categoria:</b></em> <?php echo $dados['categoria'] ?></div>
                <br>
                <div class="user10"><em><b>Gênero:</b></em> <?php echo $dados['genero'] ?></div>
                <br>
                <div class="user11"><em><b>Endereço:</b></em> <?php echo $dados['endereco'] ?></div>
                <br>
                <div class="user12"><em><b>Responsável:</b></em> <?php echo $dados['responsavel'] ?></div>
                <br>
                <div class="user13"><em><b>Data de Entrada:</b></em> <?php echo date('d/m/Y', strtotime($dados['data_entrada'])) ?></div>
                <br>
                <div class="user14"><em><b>Telefone Responsável:</b></em> <?php echo $dados['tele_respon'] ?></div>
            </div>
        </main>

        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp ">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Olá, <b>Bem-Vindo(a)</b></p>
                        <small class="text-muted"><?php echo $dados['nome'] ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="../img/perfil/<?php echo $dados['imagem'] ?>" alt="user" id="profile-picture">
                    </div>
                </div>
            </div>

            <div class="box-perfil" style="margin-top: 20px;">
                <h2>Alterar Foto de Perfil</h2>
                 <form method="post" enctype="multipart/form-data">
                    <label for="avatar-image">Selecionar Foto de Perfil</label>
                    <input type="file" name="file" id="avatar-image" aria-describedby="file-help">
                    <p id="file-help">Escolha uma imagem para a foto de perfil.</p>
                    <img class="box-perfil-img" id="preview-image" src="#" alt="Pré-visualização da Imagem">
                    <button type="submit" class="form-control" style="margin-top: 10px;">Salvar Foto</button>   
            </div>
        </div>
    </div>
    <script src="JavaScript/index.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    const avatarImage = document.querySelector('#avatar-image');
    const previewImage = document.querySelector('#preview-image');
    const profilePicture = document.querySelector('#profile-picture');

    // Listener para o evento de mudança no input de arquivo
    avatarImage.addEventListener('change', event => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(event) {
                // Define a imagem de pré-visualização e a exibe
                previewImage.src = event.target.result;
                previewImage.style.display = 'block';
                // Atualiza a imagem do perfil na interface
                profilePicture.src = event.target.result;
            }

            reader.readAsDataURL(file); // Lê o arquivo como URL de dados
        } else {
            previewImage.src = '#';
            previewImage.style.display = 'none'; // Esconde a imagem de pré-visualização se nenhum arquivo for selecionado
        }
    });

    // Verifica se há mensagem na sessão e exibe um alerta utilizando SweetAlert2 se houver
    <?php if (isset($_SESSION['mensagem'])): ?>
        Swal.fire({
            title: "<?php echo $_SESSION['titulo_mensagem']; ?>",
            text: "<?php echo $_SESSION['mensagem']; ?>",
            icon: "<?php echo $_SESSION['tipo_mensagem']; ?>"
        });
        <?php
        // Limpa as variáveis de sessão após exibir o alerta
        unset($_SESSION['mensagem']);
        unset($_SESSION['tipo_mensagem']);
        unset($_SESSION['titulo_mensagem']);
        ?>
    <?php endif; ?>
</script>

</body>
</html>
