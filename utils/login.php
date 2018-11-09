<?php
session_start();
use \ablin42\database;
use \ablin42\session;
use \ablin42\autoloader;

require ("../class/autoloader.php");
autoloader::register();

if (isset($_POST['submit_l']) && !empty($_POST['username_l']) && !empty($_POST['password_l']))
{
    $db = database::getInstance('camagru');

    $attributes['username'] = $_POST['username_l'];
    $pwd = hash('whirlpool', $_POST['password_l']);
    $req = $db->prepare("SELECT `password`, `username` FROM `user` WHERE `username` = :username", $attributes);
    foreach ($req as $elem)
    {
        if ($elem->password === $pwd)
        {
            $_SESSION['logged'] = 1;
            $_SESSION['username'] = $elem->username;
            $session = session::getInstance();;
        }
        header('Location: /Camagru/');
    }
}