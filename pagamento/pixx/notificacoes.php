<?php
require __DIR__ . 'vendor/autoload.php';

// Configurar credenciais
MercadoPago\SDK::setAccessToken('APP_USR-1228299603673792-062511-2cf7ec6e1d129bd3c26d70331d1b71ab-474362529');

// Receber notificação
$body = file_get_contents('php://input');
$notification = json_decode($body, true);

// Processar notificação
if (isset($notification['type']) && $notification['type'] == 'payment') {
    $payment = MercadoPago\Payment::find_by_id($notification['data']['id']);
    // Atualizar status do pagamento no seu sistema
    $payment->status;
}

