<?php
session_start();
include ("conexao.php");

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

// Obtém a data atual
$dataAtual = new DateTime();
$diaAtual = $dataAtual->format('d');
$mesAtual = $dataAtual->format('Y-m');

// Disponibiliza o mês atual para pagamento se não estiver disponível
if ($diaAtual == 1) {
    $sqlUpdateDisponibiliza = "INSERT INTO mensalidades (usuario_id, mes, pago) 
                                SELECT $id_usuario, DATE_FORMAT(NOW(), '%Y-%m'), 0
                                WHERE NOT EXISTS (SELECT 1 FROM mensalidades WHERE usuario_id = $id_usuario AND mes = DATE_FORMAT(NOW(), '%Y-%m'))";
    mysqli_query($conexao, $sqlUpdateDisponibiliza);
}

// Verifica se um arquivo foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['comprovante'])) {
    // Obtém o mês selecionado
    $mes_pendente = $_POST['mes_pendente'];
    $usuario_id = $_SESSION['id_usuario']; // Certifique-se de que o ID do usuário está sendo armazenado na sessão

    $arquivoTmp = $_FILES['comprovante']['tmp_name'];
    $nomeArquivo = $_FILES['comprovante']['name'];
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
    $nomeNovoArquivo = uniqid() . '.' . $extensao;
    $diretorioDestino = "../../coordenador/pagamentos/img/" . $nomeNovoArquivo;

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($arquivoTmp, $diretorioDestino)) {
        // Atualiza o banco de dados com as informações do comprovante
        $sqlUpdate = "UPDATE mensalidades SET comprovante = '$nomeNovoArquivo', pago = 1 WHERE usuario_id = $usuario_id AND mes = '$mes_pendente'";
        $resultadoUpdate = mysqli_query($conexao, $sqlUpdate);

        if ($resultadoUpdate) {
            $_SESSION['titulo_mensagem'] = 'Sucesso!';
            $_SESSION['mensagem'] = 'Comprovante enviado com sucesso!';
            $_SESSION['tipo_mensagem'] = 'success';
        } else {
            $_SESSION['titulo_mensagem'] = 'Erro!';
            $_SESSION['mensagem'] = 'Não foi possível enviar o comprovante. Por favor, tente novamente.';
            $_SESSION['tipo_mensagem'] = 'error';
        }
    } else {
        $_SESSION['titulo_mensagem'] = 'Erro!';
        $_SESSION['mensagem'] = 'Ocorreu um erro ao enviar o arquivo. Por favor, tente novamente.';
        $_SESSION['tipo_mensagem'] = 'error';
    }

    // Atualiza as mensalidades pendentes se não foram pagas até o dia 10
    if ($diaAtual > 10) {
        $sqlMesesPendentes = "SELECT mes FROM mensalidades WHERE usuario_id = $id_usuario AND pago = 0";
        $resultadoMesesPendentes = mysqli_query($conexao, $sqlMesesPendentes);

        if ($resultadoMesesPendentes) {
            while ($row = mysqli_fetch_assoc($resultadoMesesPendentes)) {
                $mesPendente = $row['mes'];
                $mesPendenteData = new DateTime($mesPendente);

                // Verifica se o mês pendente é anterior ao mês atual
                if ($mesPendenteData < $dataAtual) {
                    // Atualiza o banco de dados para marcar o mês como pago
                    $sqlUpdate = "UPDATE mensalidades SET pago = 1 WHERE usuario_id = $id_usuario AND mes = '$mesPendente'";
                    $resultadoUpdate = mysqli_query($conexao, $sqlUpdate);

                    if (!$resultadoUpdate) {
                        $_SESSION['titulo_mensagem'] = 'Erro';
                        $_SESSION['mensagem'] = 'Erro ao atualizar o mês pendente: ' . mysqli_error($conexao);
                        $_SESSION['tipo_mensagem'] = 'error';
                    }
                }
            }
        } else {
            $_SESSION['titulo_mensagem'] = 'Erro';
            $_SESSION['mensagem'] = 'Erro ao consultar os meses pendentes: ' . mysqli_error($conexao);
            $_SESSION['tipo_mensagem'] = 'error';
        }
    } else {
        $_SESSION['titulo_mensagem'] = 'Informação';
        $_SESSION['mensagem'] = 'O sistema só atualiza os meses pendentes após o dia 10.';
        $_SESSION['tipo_mensagem'] = 'info';
    }

    header("Location: index.php");
    exit();
}

// Consulta SQL para obter os meses pendentes de pagamento do usuário
$sqlMeses = "SELECT mes FROM mensalidades WHERE usuario_id = $id_usuario AND pago = 0";
$resultadoMeses = mysqli_query($conexao, $sqlMeses);

if ($resultadoMeses) {
    $meses = [];
    while ($row = mysqli_fetch_assoc($resultadoMeses)) {
        $meses[] = $row['mes'];
    }
} else {
    $_SESSION['titulo_mensagem'] = 'Erro';
    $_SESSION['mensagem'] = 'Erro ao consultar os meses pendentes: ' . mysqli_error($conexao);
    $_SESSION['tipo_mensagem'] = 'error';
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
                        <label for="mes-pendente">Selecione o Mês:</label>
                        <select name="mes_pendente" class="form-control2" id="mes-pendente" required>
                            <?php foreach ($meses as $mesPendente): ?>
                                <option value="<?php echo $mesPendente; ?>"><?php echo strtoupper($mesPendente); ?></option>
                            <?php endforeach; ?>
                        </select>
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
        document.addEventListener('DOMContentLoaded', function () {
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