<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include __DIR__.'/header.php';
    include __DIR__.'/checkout-form.php';
    include __DIR__.'/footer.php';
    return;
}

$curl = curl_init();

$payload = json_encode([
    'items' => [
        [
            'id' => '1234',
            'title' => $_POST['product-name'],
            'quantity' => (int)$_POST['product-unit'],
            'unit_price' => (float)$_POST['product-price'],
            'currency_id' => "MXN",
            'description' => '​ Dispositivo móvil de Tienda e-commerce​',
            'external_reference' => 'ja.garciavega@outlook.com',
            'picture_url' => 'https://mp-test-jorge.herokuapp.com'.$_POST['product-img'],
        ],
    ],
    'payer' => [
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'email' => $_POST['email'],
        'address' => [
            'street_name' => $_POST['street'],
            'street_number' => $_POST['number_street'],
            'zip_code' => $_POST['cp'],
        ]

    ],
    'payment_methods' => [
        'excluded_payment_types' => [
            [ 'id' => 'atm']
        ],
        'excluded_payment_methods' => [
            ['id' => 'amex']
        ],
    ],
    'installments' => 6,
    'back_urls' => [
        'success' => 'https://mp-test-jorge.herokuapp.com/thankyou.php',
        'pending' => 'https://mp-test-jorge.herokuapp.com/pending.php',
        'failure' => 'https://mp-test-jorge.herokuapp.com/failure.php',
    ],
    'notification_url' => 'https://mp-test-jorge.herokuapp.com/callback.php',
    'auto_return' => 'all',
    'x-integrator_id' => 'dev_24c65fb163bf11ea96500242ac130004',
]);

curl_setopt($curl, CURLOPT_URL, 'https://api.mercadopago.com/checkout/preferences');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181"));
curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

$result = curl_exec($curl);

curl_close($curl);

$result = json_decode($result);

if (isset($result->external_reference)) {
    echo $result->id;
    include __DIR__.'/header.php';
    include __DIR__.'/checkout-form.php';
    echo '<script src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js" data-preference-id="'. $result->id .'"></script>';
    include __DIR__.'/footer.php';
}
