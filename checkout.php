<?php

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include __DIR__.'/header.php';
    include __DIR__.'/checkout-form.php';
    include __DIR__.'/footer.php';
    return;
}

MercadoPago\SDK::setAccessToken('APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181');

$preference = new MercadoPago\Preference();
$preference->payment_methods = [
    'installments' => 6,
    'default_installments' => intval($_POST['installments']),
    'excluded_payment_methods' => [['id' => 'amex']],
    'excluded_payment_types' => [['id' => 'atm']],
];
$preference->notification_url = 'https://mp-test-jorge.herokuapp.com/callback.php';
$preference->back_urls = [
    'success' => 'https://mp-test-jorge.herokuapp.com/thankyou.php',
    'pending' => 'https://mp-test-jorge.herokuapp.com/pending.php',
    'failure' => 'https://mp-test-jorge.herokuapp.com/failure.php',
];
$preference->external_reference = 'ja.garciavega@outlook.com';

$preference->auto_return = 'approved';

$payer = new MercadoPago\Payer();
$payer->name = $_POST['name'];
$payer->surname = $_POST['surname'];
$payer->first_name = $_POST['name'];
$payer->last_name = $_POST['surname'];
$payer->email = $_POST['email'];
$payer->address = [
    'zip_code' => $_POST['cp'],
    'street_name' => $_POST['street'],
    'street_number' => $_POST['number_street'],
];
$payer->phone = [
    'area_code' => $_POST['code_phone'],
    'number' => $_POST['phone'],
];

$item = new MercadoPago\Item();
$item->id = 1234;
$item->title = $_POST['product-name'];
$item->quantity = (float)$_POST['product-unit'];
$item->unit_price = $_POST['product-price'];
$item->picture_url = 'https://mp-test-jorge.herokuapp.com'.$_POST['product-img'];
$item->description = "“​ Dispositivo móvil de Tienda e-commerce​ ”";

$preference->items = array($item);
$preference->payer = $payer;
$preference->save();

if (!isset($preference->error)) {
    file_put_contents(__DIR__.'/results.txt', '----------------\n'.$preference->id, FILE_APPEND);
    include __DIR__.'/header.php';
    include __DIR__.'/checkout-form.php';
    echo '<script src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js" data-preference-id="'. $preference->id .'"></script>';
    include __DIR__.'/footer.php';
    return;
}

var_dump($preference->error);