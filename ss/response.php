<?php 
	include_once 'composer/autoload.php'; 

    MercadoPago\SDK::setAccessToken("APP_USR-1228299603673792-062511-2cf7ec6e1d129bd3c26d70331d1b71ab-474362529");
	
	
	$payment = MercadoPago\Payment::find_by_id($_GET['data_id']);
	$payment->{'status'};
	
	$fp = fopen('log.txt', 'a');
	$html = $payment->{'status'} . ' | '. 
	$payment->{'status_detail'} . ' | '. 
	$payment->{'description'} . ' | '. 
	$payment->{'id'} ;
	$write = fwrite($fp, $html);
	
	fclose($fp);
