<?php
require_once 'vendor/autoload.php'; // Caminho para o autoload do Mercado Pago SDK

// Configure as credenciais do Mercado Pago
MercadoPago\SDK::setAccessToken('APP_USR-1228299603673792-062511-2cf7ec6e1d129bd3c26d70331d1b71ab-474362529');


// Id do pagamento a ser reembolsado
$payment_id = "ID_DO_PAGAMENTO";

// Processar o reembolso
$payment = MercadoPago\Payment::find_by_id($payment_id);
$refund = new MercadoPago\Refund();
$refund->payment_id = $payment->id;
$refund->amount = $payment->transaction_amount; // Valor total do reembolso
$refund->save();

// Verificar o status do reembolso
echo $refund->status;
?>
