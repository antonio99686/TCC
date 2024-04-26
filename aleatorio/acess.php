<?php

if ($status = 1) {

echo '
<div class="table">
    <table>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">CPF</th>
        
        </tr>';

while ($dados2 = mysqli_fetch_assoc($resultado2)) {

    echo '<tr>';
    echo "<td>" . $dados2['id_usuario'] . "</td>";
    echo "<td>" . $dados2['nome'] . "</td>";
    echo "<td>" . $dados2['email'] . "</td>";
    echo "<td>" . $dados2['CPF'] . "</td>";
    echo "<td>
            <a href='formedit.php?id_usuario=" . $dados2['id_usuario'] .
        "&nome=" . $dados2['nome'] .
        "&email=" . $dados2['email'] .
        "&CPF=" . $dados2['CPF'] . "'>
                <img src='formulario/img/lapis.png' width='20' height='20' alt='Editar'>
            </a>
            <a href='formExcluir.php?id_usuario=" . $dados2['id_usuario'] .
        "&nome=" . $dados2['nome'] .
        "&email=" . $dados2['email'] .
        "&CPF=" . $dados2['CPF'] . "'>
                <img src='formulario/img/lixeira.png' width='20' height='20' alt='Excluir'>
            </a>
        </td>";
    echo '</tr>';
}

echo '
    </table>
</div>';}
?>
<!-- =======INSERT INTO `usuario` (`id_usuario`, `statuss`, `nome`, `email`, `datas`, `CPF`, `RG`, `categoria`, `senha`, `telefone`, `matricula`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `idade`, `nom_dan`) VALUES
(1, 1, 'Antonio Carlos Mattes Mongelo', 'antoniomattes72@gmail.com', '2006-08-10', '05500840029', '2108268794', 'juvenil', '123', '5596860344', '2022324018', 'antonionMong.png', 'M', 'cohab 2', 'Raquel Mattes Mongelo', '2022-10-06', '55999982163', '17', ''),
(2, 3, 'Raquel Mattes Mongelo', 'Raquelmattes88@gmail.com', '1975-09-12', '80610420020', '1234567890', 'adulto', '123', '55999982163', '2022324058', 'raquel.jpg', 'F', 'cohab 2', 'proprio', '2034-04-12', '', '48', 'Luce Terezinha Mattes Mongelo'),
(3, 2, 'Jean de Souza', 'jean@gmail.com', '1974-05-31', '12345678900', '1234567980', 'adulto', '123', '5596441634', '2022325874', 'jean.png', 'M', 'cohab 2', 'proprio', '2022-10-05', '', '50', '');
COMMIT; ====== -->