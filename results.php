<?php
require __DIR__.'/database.php';

$database = sqlite_open(__DIR__.'/database.sqlite');

$data = sqlite_query($database, 'select * from webhooks;');

while($results[] = sqlite_fetch_array($data, SQLITE3_ASSOC)){}

var_dump($results);