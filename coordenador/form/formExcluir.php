<?php
require_once "conexao.php";
$conexao = conectar();

function excluirUsuario($conexao, $id_usuario) {
    $id_usuario = mysqli_real_escape_string($conexao, $id_usuario);

    // Check if user exists
    $sql = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) === 0) {
        return "Usuário não encontrado.";
    }

    // Delete related mensalidades first
    $sql_delete_mensalidades = "DELETE FROM mensalidades WHERE usuario_id = '$id_usuario'";
    if (!mysqli_query($conexao, $sql_delete_mensalidades)) {
        return "Erro ao excluir mensalidades: " . mysqli_error($conexao);
    }

    // Delete related roupas
    $sql_delete_roupas = "DELETE FROM roupas WHERE id_usuario = '$id_usuario'";
    if (!mysqli_query($conexao, $sql_delete_roupas)) {
        return "Erro ao excluir roupas: " . mysqli_error($conexao);
    }

    // Delete user
    $sql_delete_usuario = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";
    if (!mysqli_query($conexao, $sql_delete_usuario)) {
        return "Erro ao excluir usuário: " . mysqli_error($conexao);
    }

    // Return success message if user and related records were deleted
    if (mysqli_affected_rows($conexao) > 0) {
        return "Usuário e suas roupas foram excluídos com sucesso.";
    } else {
        return "Nenhum usuário foi excluído.";
    }
}

if (!isset($_GET['id_usuario']) || empty($_GET['id_usuario'])) {
    echo "ID do usuário não foi recebido.";
    exit();
}

$resultado_exclusao = excluirUsuario($conexao, $_GET['id_usuario']);
mysqli_close($conexao);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Exclusão de Usuário</title>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($resultado_exclusao === "Usuário e suas roupas foram excluídos com sucesso.") { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Usuário e suas roupas foram excluídos com sucesso!',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'lista.php';
                });
            <?php } else { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: '<?php echo $resultado_exclusao; ?>',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            <?php } ?>
        });
    </script>
</body>
</html>
