<?php
require_once 'vendor/autoload.php'; // Caminho para o autoload do Mercado Pago SDK

// Configure as credenciais do Mercado Pago
MercadoPago\SDK::setAccessToken('APP_USR-1228299603673792-062511-2cf7ec6e1d129bd3c26d70331d1b71ab-474362529');


// Dados da pré-autorização
$preference_data = array(
    "items" => array(
        array(
            "title" => "Produto Exemplo",
            "quantity" => 1,
            "unit_price" => 100
        )
    ),
    "payer" => array(
        "email" => "email@exemplo.com"
    ),
    "payment_methods" => array(
        "excluded_payment_methods" => array(
            array("id" => "amex")
        ),
        "excluded_payment_types" => array(
            array("id" => "ticket")
        )
    ),
    "back_urls" => array(
        "success" => "http://www.seusite.com/sucesso",
        "failure" => "http://www.seusite.com/erro",
        "pending" => "http://www.seusite.com/pendente"
    ),
    "auto_return" => "approved",
);

$preference = new MercadoPago\Preference();
$preference->items = $preference_data["items"];
$preference->payer = $preference_data["payer"];
$preference->payment_methods = $preference_data["payment_methods"];
$preference->back_urls = $preference_data["back_urls"];
$preference->auto_return = $preference_data["auto_return"];
$preference->save();

echo $preference->init_point;
?>
