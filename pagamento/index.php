<?php

session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (isset($_SESSION['id_usuario'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login.php");
    exit();
}

// Obtém o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obter os dados do usuário
$sql = "SELECT * FROM usuario WHERE id_usuario " . $_SESSION['id_usuario'];
$resultado = mysqli_query($conexao, $sql);

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    echo "Erro ao consultar o banco de dados: " . mysqli_error($conexao);
    exit();
}

// Obtém os dados do usuário
$dados = mysqli_fetch_assoc($resultado);
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participantes</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                    <span class="icon">
                            <ion-icon name="##"></ion-icon>
                        </span>
                        <span class="title"> Sentinela da Fronteira </span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

               
                
                

                
            </ul>
        </div>

        <!-- ========================= Principal ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="../img/antonionMong.png" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"></div>
                        <div class="cardName"> </div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name=""></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"></div>
                        <div class="cardName"></div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name=""></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"></div>
                        <div class="cardName"></div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name=""></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"></div>
                        <div class="cardName">Ganho</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================Lista de detalhes do pedido ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Pagamento</h2>
                        <a href="#" class="btn">Ver tudo</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Preço</td>
                                <td>Pagamento</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span class="status delivered">Entregue</span></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span class="status pending">Pendente</span></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span class="status return">Retornar</span></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span class="status inProgress">Em andamento</span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

              

    <!-- =========== Scripts =========  -->
    <script src="js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>