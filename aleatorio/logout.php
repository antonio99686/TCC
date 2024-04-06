<?php
session_start();
unset($_SESSION["id_usuario"]);
unset($_SESSION["nome"]);
session_destroy();
header("location:index.php");
exit;
?>