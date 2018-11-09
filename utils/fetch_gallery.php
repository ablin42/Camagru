<?php
use \ablin42\database;

$db = database::getInstance('camagru');

$req = $db->query("SELECT * FROM `image` LIMIT 5");
foreach($req as $item)
{
    var_dump($item->name);
}