<?php

$access_token = "APP_USR-1228299603673792-062511-2cf7ec6e1d129bd3c26d70331d1b71ab-474362529";
$valor = 30;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pix']) && $_POST['pix']) {

        require_once 'mercadopago/lib/mercadopago/vendor/autoload.php';

        MercadoPago\SDK::setAccessToken($access_token);

        $payment = new MercadoPago\Payment();
        $payment->description = 'Mensalidade';
        $payment->transaction_amount = (double)$valor;
        $payment->payment_method_id = "pix";

        $payment->notification_url = 'https://seusite.com/notification.php';
        $payment->external_reference = 1520;

        $payment->payer = array(
            "email" => 'emailcliente@gmail.com',
            "first_name" => 'Primeiro nome do cliente',
            "address" => array(
                "zip_code" => "06233200",
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "3003",
                "neighborhood" => "Bonfim",
                "city" => "Osasco",
                "federal_unit" => "SP"
            )
        );

        $payment->save();
        echo json_encode($payment->point_of_interaction);
      } else {
        echo json_encode(array(
          'status' => 'error',
          'message' => 'pix required'
        ));
      }
    } else {
      echo json_encode(array(
        'status' => 'error',
        'message' => 'post required',
        'received_method' => $_SERVER['REQUEST_METHOD'],
        'received_post' => $_POST
      ));
      var_dump('  mercadopago/lib/mercadopago/vendor/autoload.php');
}
?>
