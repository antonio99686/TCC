<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Exibição por Categoria</title>
</head>

<body>
    <h1>Exibição por Categoria</h1>

    <form method="POST">
        <label for="categoria">Selecione a Categoria:</label>
        <select id="categoria" name="categoria" onchange="this.form.submit()">
            <option value="">Selecione...</option>
            <option value=" 1">Categoria 1</option>
            <option value=" 2">Categoria 2</option>
            <!-- Adicione mais opções conforme necessário -->
        </select>
    </form>

    <div id="resultados">
        <?php
        // Verificar se a categoria foi enviada
        if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {
            // Conexão com o banco de dados (substitua com suas próprias credenciais)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "sentinelas";

            // Criando a conexão
            $conn = new mysqli($servername, $username, $password, $database);

            // Verificando a conexão
            if ($conn->connect_error) {
                die("Erro de conexão: " . $conn->connect_error);
            }

            // Evitar SQL injection
            $status = $conn->real_escape_string($_POST['categoria']);

            // Consulta SQL para buscar os dados da selecionada
            $sql = "SELECT * FROM usuario WHERE statuss = '$status'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Exibindo os resultados em uma tabela
                echo '<table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <!-- Adicione mais colunas conforme necessário -->
                        </tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <td>' . $row['id_usuario'] . '</td>
                            <td>' . $row['nome'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['CPF'] . '</td>
                            <!-- Adicione mais colunas conforme necessário -->
                        </tr>';
                }
                echo '</table>';
            } else {
                echo 'Nenhum resultado encontrado para essa categoria.';
            }

            // Fechar conexão
            $conn->close();
        }
        ?>
    </div>
</body>

</html>