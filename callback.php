<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__.'/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') { header('Location: /'); }

MercadoPago\SDK::setAccessToken("APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181");

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

file_put_contents(__DIR__.'/results.txt', json_encode([
    'id' => isset($_POST['id']) ? $_POST['id'] : 'null',
    'live_mode' => isset($_POST['live_mode']) ? $_POST['live_mode'] : 'null',
    'type' => isset($_POST['type']) ? $_POST['type'] : 'null',
    'date_created' => isset($_POST['date_created']) ? $_POST['date_created'] : 'null',
    'application_id' => isset($_POST['application_id']) ? $_POST['application_id'] : 'null',
    'user_id' => isset($_POST['user_id']) ? $_POST['user_id'] : 'null',
    'version' => isset($_POST['version']) ? $_POST['version'] : 'null',
    'api_version' => isset($_POST['api_version']) ? $_POST['api_version'] : 'null',
    'action' => isset($_POST['action']) ? $_POST['action'] : 'null',
    'data' => isset($_POST['data']) ? $_POST['data'] : 'null',
]));

return http_response_code(200);
