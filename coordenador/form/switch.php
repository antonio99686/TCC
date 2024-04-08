<?php
// Conectar ao BD
include ("conexao.php");

// Seleciona todos os dados da tabela lista

$sql = "SELECT * FROM usuario";
// Executa o Select
$resultado = mysqli_query($conexao, $sql);



switch ($status) {
    case 1:
        echo '<div class="table">
        <table>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
            
            
           
      
          </tr>';

        while ($dados = mysqli_fetch_assoc($resultado)) {
            echo '<tr>';
            echo "<td>" . $_SESSION['id_usuario'] . "</td>";
            echo "<td>" . $_SESSION['nome'] . "</td>";
            echo "<td>" . $_SESSION['email'] . "</td>";
            echo "<td>" . $_SESSION['CPF'] . "</td>";


            echo '</tr>';

            echo "<td><a href='formedit.php?" .
                "&nome=" . $_SESSION['nome'] .
                "&email=" . $_SESSION['email'] .
                "&email=" . $_SESSION['CPF'] .






                "' </td>>" . "<img src='img/settings.png' 'widht='20' height='20'" . "</a> ";

            echo "<td><a href='exclui.php?" .
                "&nome=" . $_SESSION['nome'] .
                "&email=" . $_SESSION['email'] .
                "&email=" . $_SESSION['CPF'] .






                "'>" . "<img src='img/settings.png' 'widht='20' height='20'" . "</a>";
        }
        echo '</table>
      </div>';
        break;
    case 2:
        echo '<div class="table">
        <table>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
            
            
           
      
          </tr>';

        while ($dados = mysqli_fetch_assoc($resultado)) {
            echo '<tr>';
            echo "<td>" . $_SESSION['id_usuario'] . "</td>";
            echo "<td>" . $_SESSION['nome'] . "</td>";
            echo "<td>" . $_SESSION['email'] . "</td>";
            echo "<td>" . $_SESSION['CPF'] . "</td>";


            echo '</tr>';

            echo "<td><a href='formedit.php?" .
                "&nome=" . $_SESSION['nome'] .
                "&email=" . $_SESSION['email'] .
                "&email=" . $_SESSION['CPF'] .






                "' </td>>" . "<img src='img/settings.png' 'widht='20' height='20'" . "</a> ";

            echo "<td><a href='exclui.php?" .
                "&nome=" . $_SESSION['nome'] .
                "&email=" . $_SESSION['email'] .
                "&email=" . $_SESSION['CPF'] .






                "'>" . "<img src='img/settings.png' 'widht='20' height='20'" . "</a>";
        }
        echo '</table>
      </div>';
        break;
    case 3:
        echo '<div class="table">
        <table>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
            
            
           
      
          </tr>';

        while ($dados = mysqli_fetch_assoc($resultado)) {
            echo '<tr>';
            echo "<td>" . $_SESSION['id_usuario'] . "</td>";
            echo "<td>" . $_SESSION['nome'] . "</td>";
            echo "<td>" . $_SESSION['email'] . "</td>";
            echo "<td>" . $_SESSION['CPF'] . "</td>";


            echo '</tr>';

            echo "<td><a href='formedit.php?" .
                "&nome=" . $_SESSION['nome'] .
                "&email=" . $_SESSION['email'] .
                "&email=" . $_SESSION['CPF'] .






                "' </td>>" . "<img src='img/settings.png' 'widht='20' height='20'" . "</a> ";

            echo "<td><a href='exclui.php?" .
                "&nome=" . $_SESSION['nome'] .
                "&email=" . $_SESSION['email'] .
                "&email=" . $_SESSION['CPF'] .






                "'>" . "<img src='img/settings.png' 'widht='20' height='20'" . "</a>";
        }
        echo '</table>
      </div>';
        break;

    default:
        # code...
        break;
}




//Lista os itens

?>