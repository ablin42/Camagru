<?php
use \ablin42\database;
use \ablin42\autoloader;
use \ablin42\alertHtml;

if (isset($_GET['id']) && isset($_GET['token']))
{
    if (isset($_POST['submit']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        require("../class/autoloader.php");
        autoloader::register();
        $alertHtml = new alertHtml();
        $attributes['id'] = $_GET['id'];
        $db = database::getInstance('camagru');

        $req = $db->prepare("SELECT `password_token` FROM `user` WHERE `id` = :id", $attributes);
        $attributes['password'] = hash("whirlpool", $_POST['password']);
        foreach ($req as $item)
        {
            if ($item->password_token === $_GET['token'])
                $db->prepare("UPDATE `user` SET `password_token` = NULL, `password` = :password WHERE `id` = :id", $attributes);
        }
    }
}
header('Location: /Camagru/');