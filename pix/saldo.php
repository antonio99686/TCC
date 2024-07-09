<?php

// Substitua pelas suas credenciais do Mercado Pago
$access_token = 'APP_USR-1228299603673792-062511-2cf7ec6e1d129bd3c26d70331d1b71ab-474362529';

// Endpoint para consultar saldo
$url = 'https://api.mercadopago.com/users/474362529/mercadopago_account/balance?access_token=' . $access_token;

// Inicia uma nova sessão cURL
$ch = curl_init();

// Configura as opções da requisição cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desabilita a verificação SSL

// Executa a requisição e obtém a resposta
$response = curl_exec($ch);

// Verifica se houve algum erro na requisição cURL
if(curl_errno($ch)) {
    echo 'Erro ao acessar a API do Mercado Pago: ' . curl_error($ch);
    exit;
}

// Decodifica a resposta JSON
$data = json_decode($response, true);

// Verifica se a consulta foi bem-sucedida
if(isset($data['response']['balance'])) {
    $saldo = $data['response']['balance'];
    echo 'Saldo atual do Mercado Pago: ' . $saldo;
} else {
    // Verifica se há mensagem de erro da API
    if(isset($data['message'])) {
        echo 'Erro na API do Mercado Pago: ' . $data['message'];
    } else {
        echo 'Não foi possível obter o saldo do Mercado Pago.';
    }
}

// Fecha a sessão cURL
curl_close($ch);
?>
