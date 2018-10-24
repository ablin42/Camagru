<?php

use \ablin42\database;
use \ablin42\autoloader;
require ("class/autoloader.php");
autoloader::register();

$db = new database('camagru', 'localhost', 'root', '');
$data = $db->query("SELECT * FROM user");
foreach ($data as $elem)
{
    echo $elem->username . PHP_EOL;
    echo $elem->email . PHP_EOL;
}
