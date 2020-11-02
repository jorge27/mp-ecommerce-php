<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__.'/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') { header('Location: /'); }

MercadoPago\SDK::setAccessToken("token");

switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        break;
    case "plan":
        $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
        break;
    case "subscription":
        $plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
        break;
    case "invoice":
        $plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
        break;
}
file_put_contents(__DIR__.'/results.txt', json_encode($_POST), FILE_APPEND);
file_put_contents(__DIR__.'/results.txt', file_get_contents('php://input'), FILE_APPEND);

return http_response_code(200);
