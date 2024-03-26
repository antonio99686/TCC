<?php

$bdServidor = "localhost";
$bdUsuario = "root";
$bdSenha = "";
$bdBanco = "sentinelas";
$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

if (mysqli_connect_errno()) {
    echo "Problemas para conectar no banco. Erro: ";
    echo mysqli_connect_error();
    die();
}