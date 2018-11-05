<?php

use \ablin42\database;
use \ablin42\autoloader;
require ("class/autoloader.php");
autoloader::register();

$db = database::getInstance('camagru');
$req = $db->query('SELECT * FROM user');
var_dump($req);
foreach ($req as $item)
{
    var_dump($item->username);
}