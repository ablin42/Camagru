<?php
use \ablin42\database;
use \ablin42\autoloader;

require ("../class/autoloader.php");
autoloader::register();

$attributes['username'] = $_GET['id'];

$db = database::getInstance('camagru');
$req = $db->prepare("SELECT `mail_token` FROM `user` WHERE `username` = :username", $attributes);

foreach ($req as $item)
{
    if ($item->mail_token === $_GET['token'])
        $db->prepare("UPDATE `user` SET `mail_token` = 'NULL', `confirmed_token` = NOW() WHERE `username` = :username", $attributes);

}
header('Location: /Camagru/');