<?php
require __DIR__ . '/vendor/autoload.php';
MercadoPago\SDK::setAccessToken('token');

$preference = new MercadoPago\Preference();
$preference->payment_methods->excluded_payment_methods = ['amex', 'atm'];
$preference->installments = 6;

$reference->payer->name = 'Lalo';
$reference->payer->surname = 'Landa';


$item = new MercadoPago\Item();
$item->title = $_POST['title'];
$item->quantity = $_POST['unit'];
$item->unit_price = $_POST['price'];

$preference->items = array($item);
$preference->save();
