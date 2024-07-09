<?php
require_once 'vendor/autoload.php'; // Caminho para o autoload do Mercado Pago SDK

// Configure as credenciais do Mercado Pago
MercadoPago\SDK::setAccessToken('APP_USR-1228299603673792-062511-2cf7ec6e1d129bd3c26d70331d1b71ab-474362529');


// ID do pagamento a ser cancelado
$payment_id = "ID_DO_PAGAMENTO";

$payment = MercadoPago\Payment::find_by_id($payment_id);
$payment->status = "cancelled";
$payment->save();

echo "Pagamento cancelado.";
?>
