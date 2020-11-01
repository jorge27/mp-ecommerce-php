<?php
require __DIR__.'/database.php';

$database = sqlite_open(__DIR__.'/database.sqlite');

$data = sqlite_query($database, 'select * from webhooks;');

var_dump($data);