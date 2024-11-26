<?php
session_start(); // Inicia a sessão
require_once "../../conexao.php"; // Inclui o arquivo de conexão com o banco de dados
$conexao = conectar(); // Conecta ao banco de dados

error_reporting(E_ALL); // Define que todos os erros sejam reportados
ini_set('display_errors', 1); // Exibe os erros no navegador (útil para desenvolvimento)

// Verifica se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php"); // Redireciona para a página de login se o usuário não estiver autenticado
    exit(); // Finaliza o script
}

// Obtém os dados do usuário logado a partir da sessão
$id_usuario = $_SESSION['id_usuario'];

// Prepara uma consulta SQL para obter os dados do usuário logado, com proteção contra SQL Injection
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$dados = $resultado->fetch_assoc();

// Verifica se foi feita uma requisição de busca de usuários (via método GET)
if (isset($_GET['nome_usuario'])) {
    $nome_usuario = $_GET['nome_usuario'];

    // Prepara uma consulta SQL para buscar usuários que correspondam ao nome, protegendo contra SQL Injection
    $sql = "SELECT id_usuario, nome FROM usuario WHERE nome LIKE ? AND statuss = 1 ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
    $search_term = '%' . $nome_usuario . '%';
    $stmt->bind_param('s', $search_term);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Monta um array com os resultados dos usuários encontrados
    $usuarios = [];
    while ($usuario = $resultado->fetch_assoc()) {
        $usuarios[] = $usuario; // Adiciona cada usuário ao array
    }

    echo json_encode($usuarios); // Retorna os usuários encontrados em formato JSON
    exit(); // Finaliza o script
}

// Verifica se foi feita uma requisição de busca de mensalidades (via método GET)
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario']; // Obtém o id do usuário da requisição

    // Prepara uma consulta SQL para buscar as mensalidades do usuário, com proteção contra SQL Injection
    $sql = "SELECT id, mes, pago, comprovante FROM mensalidades WHERE usuario_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Monta um array com os resultados das mensalidades encontradas
    $mensalidades = [];
    while ($mensalidade = $resultado->fetch_assoc()) {
        $mensalidades[] = $mensalidade;
    }

    echo json_encode($mensalidades);
    exit(); // Finaliza o script
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
    <link rel="stylesheet" href="css/pag.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Sentinela da fronteira</title>
</head>
<style>
    .download {
        color: black;
    }

    .download:hover {
        color: red;
    }

    .download.disabled {
        color: gray;
        cursor: not-allowed;
        text-decoration: none;
    }
</style>

<body>
    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <h2>Unindo Forças é <span class="danger">Bem Mais Facíl </span></h2>
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
                <a href="../calen">
                    <span class="material-icons-sharp">
                        event
                    </span>
                    <h3>Calendario</h3>
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
                <a href="../../email">
                    <span class="material-icons-sharp">email</span>
                    <h3>Email</h3>
                </a>
                <a href="../logout.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main>
            <h1>Pagamentos</h1>
          

            <div class="box">
                <div class="form-group">
                    <label for="nome_usuario">Digite o nome do usuário:</label>
                    <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" onkeyup="buscarUsuarios()">
                </div>
                <div id="resultados_busca"></div>
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
                        <img src="../../img/perfil/<?php echo $dados['imagem'] ?>" alt="user">
                    </div>
                </div>
            </div>

            <div class="user-profile">
                <div class="logo text-center">
                    <h1>Gerar Relatório de Mensalidades</h1>
                    <form id="relatorioForm" action="PDF/index.php" method="GET">
                        <label for="mes_selecionado">Selecione o mês:</label>
                        <input type="month" class="form-control" id="mes_selecionado" name="mes_selecionado" required>
                        <button type="button" class="btn_relatorio" id="gerarRelatorio">Gerar Relatório</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script src="../JavaScript/index.js"></script>
    <script>
        document.getElementById('gerarRelatorio').addEventListener('click', function () {
            // Obtém o valor do campo de seleção do mês
            const mesSelecionado = document.getElementById('mes_selecionado').value;

            if (!mesSelecionado) {
                // Exibe um alerta caso o mês não tenha sido selecionado
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Por favor, selecione um mês antes de gerar o relatório.'
                });
                return;
            }

            // Exibe o modal de confirmação
            Swal.fire({
                title: 'Gerar Relatório',
                text: `Deseja gerar o relatório para o mês ${mesSelecionado}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, gerar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Envia o formulário se o usuário confirmar
                    document.getElementById('relatorioForm').submit();
                }
            });
        });
    </script>
    <script>
        function buscarUsuarios() {
            // Obtém o valor do campo de entrada com id 'nome_usuario'
            const nomeUsuario = document.getElementById('nome_usuario').value;
            console.log(`Buscando usuários com o nome: ${nomeUsuario}`); // Log para depuração

            // Verifica se o campo de busca não está vazio
            if (nomeUsuario.length > 0) {
                const xhr = new XMLHttpRequest(); // Cria um novo objeto XMLHttpRequest
                xhr.open('GET', `?nome_usuario=${nomeUsuario}`, true); // Prepara a requisição GET para buscar usuários
                xhr.onload = function() {
                    if (this.status === 200) { // Verifica se a requisição foi bem-sucedida
                        try {
                            const resultados = JSON.parse(this.responseText); // Tenta analisar a resposta JSON
                            let output = '<ul>'; // Inicia a construção da lista de resultados
                            resultados.forEach(function(usuario) {
                                // Cria um item de lista para cada usuário encontrado
                                output += `<li><a href="#" onclick="buscarMensalidades(${usuario.id_usuario}, '${usuario.nome}')">${usuario.nome}</a></li>`;
                            });
                            output += '</ul>'; // Fecha a lista
                            document.getElementById('resultados_busca').innerHTML = output; // Atualiza o DOM com os resultados
                        } catch (e) {
                            console.error('Error parsing JSON:', e); // Log de erro se a análise falhar
                            console.error('Response was:', this.responseText); // Exibe a resposta para depuração
                        }
                    }
                };
                xhr.send(); // Envia a requisição
            } else {
                // Se o campo estiver vazio, limpa os resultados da busca
                document.getElementById('resultados_busca').innerHTML = '';
            }
        }

        function buscarMensalidades(idUsuario, nomeUsuario) {
            console.log(`Buscando mensalidades para o usuário: ${nomeUsuario} (ID: ${idUsuario})`); // Log para depuração
            const xhr = new XMLHttpRequest(); // Cria um novo objeto XMLHttpRequest
            xhr.open('GET', `?id_usuario=${idUsuario}`, true); // Prepara a requisição GET para buscar mensalidades
            xhr.onload = function() {
                if (this.status === 200) { // Verifica se a requisição foi bem-sucedida
                    try {
                        const mensalidades = JSON.parse(this.responseText); // Tenta analisar a resposta JSON
                        let content = `<h3>Mensalidades de ${nomeUsuario}</h3>`; // Inicia o conteúdo para o SweetAlert
                        if (mensalidades.length > 0) {
                            // Se houver mensalidades, cria uma tabela para exibi-las
                            content += "<table><tr><th>Mês</th><th>Status</th><th>Comprovante</th></tr>";
                            mensalidades.forEach(function(mensalidade) {
                                const comprovanteLink = mensalidade.comprovante ?
                                    `download_comprovante.php?id=${mensalidade.id}` : '#'; // Define o link do comprovante
                                const status = mensalidade.pago == 1 ? 'Pago' : 'Não Pago'; // Define o status da mensalidade

                                // Se não estiver pago, desativa o link de download
                                const downloadLink = mensalidade.pago == 1 && mensalidade.comprovante ?
                                    `<a href="${comprovanteLink}" class="download">Download</a>` :
                                    '<span class="download disabled">Download indisponível</span>';

                                content += `<tr>
                            <td>${mensalidade.mes}</td> 
                            <td>${status}</td> 
                            <td>${downloadLink}</td> 
                        </tr>`;
                            });
                            content += "</table>"; // Fecha a tabela
                        } else {
                            content += "<p>Não há pendências.</p>"; // Mensagem caso não haja mensalidades
                        }
                        abrirSweetAlert(content); // Abre o SweetAlert com o conteúdo gerado
                    } catch (e) {
                        console.error('Error parsing JSON:', e); // Log de erro se a análise falhar
                        console.error('Response was:', this.responseText); // Exibe a resposta para depuração
                    }
                }
            };
            xhr.send(); // Envia a requisição
        }

        function abrirSweetAlert(content) {
            // Configura e exibe o SweetAlert com o conteúdo fornecido
            Swal.fire({
                title: 'Detalhes das Mensalidades',
                html: content,
                icon: 'info',
                showCloseButton: true // Exibe um botão para fechar
            });
        }

        // Adiciona um listener para cliques no documento
        document.addEventListener('click', function(event) {
            if (event.target.matches('.download')) { // Verifica se o elemento clicado tem a classe 'download'
                event.preventDefault(); // Previne o comportamento padrão do link
                const link = event.target.getAttribute('href'); // Obtém o link do atributo href
                if (link !== '#') { // Verifica se o link não é '#'
                    window.location.href = link; // Redireciona para o link de download
                } else {
                    // Se não houver link de download, exibe um alerta
                    Swal.fire({
                        title: 'Aviso',
                        text: 'Nenhum comprovante disponível para download.',
                        icon: 'warning',
                        confirmButtonText: 'Ok' // Texto do botão de confirmação
                    });
                }
            }
        });
    </script>
</body>

</html>