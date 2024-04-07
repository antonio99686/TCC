<?php
session_start();
unset($_SESSION["id_usuario"]);
unset($_SESSION["status"]);
session_destroy();
echo "<script>alert('deslidado');</script>";
echo "<script>location.href='../index.php';</script>";
exit;
?>