<?php
session_start();
include("conexao.php");

// Aguarda 1 segundo antes de redirecionar o usuário
sleep(1);

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário
$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
$resultado = mysqli_query($conexao, $sql);

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    $_SESSION['titulo_mensagem'] = 'Erro';
    $_SESSION['mensagem'] = 'Erro ao consultar o banco de dados: ' . mysqli_error($conexao);
    $_SESSION['tipo_mensagem'] = 'error';
    header("Location: ../pagamento");
    exit();
}

// Obtém os dados do usuário
$dados = mysqli_fetch_assoc($resultado);

// Inicializa o array $meses
$meses = [];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['comprovante'])) {
    // Obtém os arquivos de comprovante
    $files = $_FILES['comprovante'];

    // Processamento dos arquivos de comprovante
    foreach ($files['name'] as $index => $filename) {
        $file = [
            'name' => $files['name'][$index],
            'tmp_name' => $files['tmp_name'][$index],
            'type' => $files['type'][$index],
            'error' => $files['error'][$index],
            'size' => $files['size'][$index]
        ];

        // Obtém o mês atual para cada arquivo
        $mes = date('F', strtotime("+$index month"));

        // Diretório para salvar o arquivo enviado
        $uploadDir = '../../img/comprovantes/';
        $uploadFile = $uploadDir . basename($file['name']);
        $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // Tipos de arquivo permitidos
        $allowedTypes = ['png', 'jpg', 'jpeg', 'pdf'];

        if (in_array($fileType, $allowedTypes)) {
            // Move o arquivo enviado para o diretório do servidor
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                // Verifica se já existe um registro para o mês atual
                $sql_check = "SELECT * FROM mensalidades WHERE usuario_id = '$id_usuario' AND mes = '$mes' AND pago = 0";
                $result_check = mysqli_query($conexao, $sql_check);

                if (!$result_check) {
                    $_SESSION['titulo_mensagem'] = 'Erro';
                    $_SESSION['mensagem'] = 'Erro ao consultar o banco de dados: ' . mysqli_error($conexao);
                    $_SESSION['tipo_mensagem'] = 'error';
                } elseif (mysqli_num_rows($result_check) > 0) {
                    // Atualiza o comprovante existente
                    $sql_update = "UPDATE mensalidades SET comprovante = '$uploadFile' WHERE usuario_id = '$id_usuario' AND mes = '$mes' AND pago = 1 ";
                    if (mysqli_query($conexao, $sql_update)) {
                        $_SESSION['titulo_mensagem'] = 'Sucesso';
                        $_SESSION['mensagem'] = 'Comprovante atualizado com sucesso!';
                        $_SESSION['tipo_mensagem'] = 'success';
                        $meses[] = $mes;
                    } else {
                        $_SESSION['titulo_mensagem'] = 'Erro';
                        $_SESSION['mensagem'] = 'Erro ao atualizar no banco de dados: ' . mysqli_error($conexao);
                        $_SESSION['tipo_mensagem'] = 'error';
                    }
                } else {
                    // Insere um novo registro
                    $sql_insert = "INSERT INTO mensalidades (usuario_id, mes, pago, comprovante) VALUES ('$id_usuario', '$mes', 0, '$uploadFile')";
                    if (mysqli_query($conexao, $sql_insert)) {
                        $_SESSION['titulo_mensagem'] = 'Sucesso';
                        $_SESSION['mensagem'] = 'Comprovante enviado com sucesso!';
                        $_SESSION['tipo_mensagem'] = 'success';
                        $meses[] = $mes;
                    } else {
                        $_SESSION['titulo_mensagem'] = 'Erro';
                        $_SESSION['mensagem'] = 'Erro ao salvar no banco de dados: ' . mysqli_error($conexao);
                        $_SESSION['tipo_mensagem'] = 'error';
                    }
                }
            } else {
                $_SESSION['titulo_mensagem'] = 'Erro';
                $_SESSION['mensagem'] = 'Erro ao fazer o upload do arquivo.';
                $_SESSION['tipo_mensagem'] = 'error';
            }
        } else {
            $_SESSION['titulo_mensagem'] = 'Erro';
            $_SESSION['mensagem'] = 'Tipo de arquivo não permitido.';
            $_SESSION['tipo_mensagem'] = 'error';
        }
    }

    // Redireciona para a página de pagamentos após processamento
    header("Location: ../pagamento");
    exit();
}

// Consulta SQL para obter os meses pendentes de pagamento
$sql_meses_pendentes = "SELECT DISTINCT mes FROM mensalidades WHERE usuario_id = '$id_usuario' AND pago = 0";
$resultado_meses_pendentes = mysqli_query($conexao, $sql_meses_pendentes);

// Verifica se houve erro na consulta
if (!$resultado_meses_pendentes) {
    $_SESSION['titulo_mensagem'] = 'Erro';
    $_SESSION['mensagem'] = 'Erro ao consultar meses pendentes: ' . mysqli_error($conexao);
    $_SESSION['tipo_mensagem'] = 'error';
    header("Location: ../pagamento");
    exit();
}

// Obter o mês atual para comparação
$mesAtual = date('m');

// Itera sobre os resultados para obter os meses pendentes
while ($row = mysqli_fetch_assoc($resultado_meses_pendentes)) {
    $mesPendente = $row['mes'];
    $mesPendenteNumero = date('m', strtotime($mesPendente));

    // Verifica se já passou do dia 10 do mês seguinte ao mês pendente
    $dataLimite = date('Y-m-10', strtotime("+1 month", strtotime($mesPendente)));
    $dataAtual = date('Y-m-d');

    if ($dataAtual > $dataLimite) {
        // Insere automaticamente o mês na tabela 'mensalidades'
        $sql_insert = "INSERT INTO mensalidades (usuario_id, mes, pago, comprovante) VALUES ('$id_usuario', '$mesPendente', 0, '')";
        if (mysqli_query($conexao, $sql_insert)) {
            $_SESSION['titulo_mensagem'] = 'Aviso';
            $_SESSION['mensagem'] = "O mês de $mesPendente foi cadastrado automaticamente devido ao atraso no pagamento.";
            $_SESSION['tipo_mensagem'] = 'warning';
            $meses[] = $mesPendente;
        } else {
            $_SESSION['titulo_mensagem'] = 'Erro';
            $_SESSION['mensagem'] = 'Erro ao cadastrar automaticamente no banco de dados: ' . mysqli_error($conexao);
            $_SESSION['tipo_mensagem'] = 'error';
        }
    }

    // Adiciona o mês pendente ao array de meses apenas se ainda não estiver pago
    if (!in_array($mesPendente, $meses)) {
        $meses[] = $mesPendente;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../../img/img/icon.png">
    <link rel="stylesheet" href="css/style.css">
    <title>Sentinela da Fronteira</title>
    <style>
        .preview-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .preview-container img,
        .preview-container .pdf-icon {
            max-width: 100%;
            height: auto;
        }

        .pdf-icon {
            font-size: 50px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Seção da barra lateral -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Unindo Forças é <span class="danger">Bem Mais Fácil</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="../dashboard.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="../participantes">
                    <span class="material-icons-sharp">
                        groups
                    </span>
                    <h3>Users</h3>
                </a>

                <a href="../perfil.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Perfil</h3>
                </a>
                <a href="../calen" target="_blank">
                    <span class="material-icons-sharp">
                        event
                    </span>
                    <h3>Calendário</h3>
                </a>
                <a href="../pagamentos" class="active">
                    <span class="material-icons-sharp">
                        paid
                    </span>
                    <h3>Pagamento</h3>
                </a>
                <a href="../acessorios">
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
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Pagamentos</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">

                    </div>
                </div>
                <div class="visits">
                    <div class="status">

                    </div>
                </div>
                <div class="searches">
                    <div class="status">

                    </div>
                </div>
            </div>
            <!-- End of Analyses -->

            <!-- New Users Section -->
            <div class="new-users">
                <h2>Mensalidades Pendentes</h2>
                <div class="user-list">
                    <div class="user">

                        <h2><?php echo $dados['nome'] ?></h2>
                        <?php foreach ($meses as $mesPago): ?>
                            <p>Falta pagar o mês de: <?php echo strtoupper($mesPago); ?></p>
                        <?php endforeach; ?>

                    </div>

                </div>
            </div>
            <!-- End of New Users Section -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Forma de Pagamento</h2>
                <table>
                    <thead>
                        <tr>
                            <th>LINK - Pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>
                            <?php
                            require_once "../../pix/gerar_checkot.php";
                            ?>
                        </td>
                    </tbody>
                </table>
            </div>
            <!-- End of Recent Orders -->

        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
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
                        <img src="../../img/perfil/<?php echo $dados['imagem'] ?>" alt="user">
                    </div>
                </div>
            </div>
            <!-- End of Nav -->

            <!-- User Profile Section -->

            <div class="user-profile">
                <div class="logo">
                    <h2>Comprovante</h2>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="comprovante" id="comprovante-file" accept=".png, .jpg, .jpeg, .pdf"
                            required>
                        <div class="preview-container">
                            <img class="box-comprovante-img" id="preview-comprovante" src="#" alt="Preview"
                                style="display:none;">
                            <span class="pdf-icon material-icons-sharp" style="display:none;">picture_as_pdf</span>
                        </div>
                        <button type="submit" class="form-control" style="margin-top: 10px;">Enviar Comprovante</button>
                    </form>
                </div>
            </div>
            <!-- End of User Profile Section -->
        </div>
    </div>
    <!-- End of User Profile Section -->
    </div>
    </div>
    <script src="JavaScript/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const comprovanteFile = document.querySelector('#comprovante-file');
        const previewComprovante = document.querySelector('#preview-comprovante');
        const pdfIcon = document.querySelector('.pdf-icon');

        comprovanteFile.addEventListener('change', event => {
            const file = event.target.files[0];
            if (file) {
                const fileType = file.type;
                if (fileType === 'application/pdf') {
                    previewComprovante.style.display = 'none';
                    pdfIcon.style.display = 'block';
                } else {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        if (fileType.startsWith('image/')) {
                            previewComprovante.src = event.target.result;
                            previewComprovante.style.display = 'block';
                            pdfIcon.style.display = 'none';
                        } else {
                            // Fallback for non-image files
                            previewComprovante.style.display = 'none';
                            pdfIcon.style.display = 'none';
                        }
                    }
                    reader.readAsDataURL(file);
                }
            } else {
                previewComprovante.src = '#';
                previewComprovante.style.display = 'none';
                pdfIcon.style.display = 'none';
            }
        });

        <?php if (isset($_SESSION['mensagem'])): ?>
            Swal.fire({
                title: "<?php echo $_SESSION['titulo_mensagem']; ?>",
                text: "<?php echo $_SESSION['mensagem']; ?>",
                icon: "<?php echo $_SESSION['tipo_mensagem']; ?>"
            }).then(() => {
                <?php
                unset($_SESSION['mensagem']);
                unset($_SESSION['tipo_mensagem']);
                unset($_SESSION['titulo_mensagem']);
                ?>
            });
        <?php endif; ?>
    });
</script>

    <script src="../JavaScript/index.js"></script>
</body>
</html>
