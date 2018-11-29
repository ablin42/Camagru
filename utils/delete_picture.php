<?php
use \ablin42\database;

if (isset($_GET['id']) && isset($_GET['r']) && $_GET['r'] === 'd' && !empty($_SESSION['id']))
{
    $db = database::getInstance('camagru');

    $attributes['id'] = $_GET['id'];
    $attributes['id_user'] = $_SESSION['id'];
    $req = $db->prepare("SELECT * FROM `image` WHERE `id` = :id AND `id_user` = :id_user", $attributes);
    if ($req)
    {
        $req = $db->prepare("DELETE FROM `image` WHERE `id` = :id", array('id' => $_GET['id']));
        echo alert_bootstrap("success", "Your picture has been successfully <b>deleted</b>!", "text-align: center;");
    }
    else
        echo alert_bootstrap("warning", "This picture is not yours or does not exist.", "text-align: center;");
}