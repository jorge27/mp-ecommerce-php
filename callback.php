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

$database = sqlite_open(__DIR__.'/database.sqlite');

sqlite_query($database, 'insert into webhooks(json) values("'.json_encode([
    'id' => $_POST['id'],
    'live_mode' => $_POST['live_mode'],
    'type' => $_POST['type'],
    'date_created' => $_POST['date_created'],
    'application_id' => $_POST['application_id'],
    'user_id' => $_POST['user_id'],
    'version' => $_POST['version'],
    'api_version' => $_POST['api_version'],
    'action' => $_POST['action'],
    'data' => $_POST['data'],
]).'");');