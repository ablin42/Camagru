<?php
session_start();
use \ablin42\database;
use \ablin42\alertHtml;
use \ablin42\session;
use \ablin42\autoloader;

require ("../class/autoloader.php");
autoloader::register();

if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']))
{
    $alertHtml = new alertHtml();
    $db = new database('camagru', 'localhost', 'root', '');

    $attributes['username'] = $_POST['username'];
    $pwd = hash('whirlpool', $_POST['password']);
    $req = $db->prepare("SELECT `password`, `username` FROM `user` WHERE `username` = :username", $attributes);
    foreach ($req as $elem)
    {
        if ($elem->password === $pwd)
        {
            $_SESSION['logged'] = 1;
            $_SESSION['username'] = $elem->username;
            $session = session::getInstance();;
            header('Location: ../index.php');
        }
    }

}