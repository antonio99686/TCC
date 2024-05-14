<?php
// Inclua o arquivo de conexão com o banco de dados
include('conexao.php');

// Função para realizar um pagamento
function realizarPagamento($idUsuario, $valor, $conexao)
{
    // Verificar se o saldo do usuário é suficiente para o pagamento
    $saldoSuficiente = verificarSaldoSuficiente($idUsuario, $valor, $conexao);

    if ($saldoSuficiente) {
        // Registrar o pagamento na tabela de pagamentos
        $sql = "INSERT INTO pagamentos (id_usuario, valor, data_pagamento) VALUES ('$idUsuario', '$valor', NOW())";
        if ($conexao->query($sql) === TRUE) {
            // Atualizar o saldo do usuário
            $sqlUpdate = "UPDATE usuario SET saldo = saldo - $valor WHERE id = $idUsuario";
            if ($conexao->query($sqlUpdate) === TRUE) {
                return true; // Retorna verdadeiro para indicar que o pagamento foi bem-sucedido
            } else {
                return false; // Retorna falso se houver algum erro ao atualizar o saldo do usuário
            }
        } else {
            return false; // Retorna falso se houver algum erro ao registrar o pagamento
        }
    } else {
        return false; // Retorna falso se o saldo não for suficiente
    }
}

// Função para listar pagamentos de um usuário
function listarPagamentos($idUsuario, $conexao)
{
    $sql = "SELECT * FROM pagamentos WHERE id_usuario = $idUsuario";
    $result = $conexao->query($sql);

    $pagamentos = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pagamentos[] = $row;
        }
    }

    return $pagamentos;
}

// Função para verificar se o saldo do usuário é suficiente para o pagamento
function verificarSaldoSuficiente($idUsuario, $valor, $conexao)
{
    $sql = "SELECT saldo FROM usuario WHERE id_usuario = $idUsuario";

    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $saldo = $row['saldo'];
        return $saldo >= $valor;
    } else {
        return false;
    }
}



?>
