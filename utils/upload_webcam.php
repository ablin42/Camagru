<?php

use \ablin42\autoloader;
use \ablin42\database;

require ("../class/autoloader.php");
autoloader::register();

if (isset($_POST['submit_cam']) && !empty($_POST['img_url']) && !empty($_POST['id_user_cam']) && !empty($_POST['img_name_cam']))
{
    $db = database::getInstance('camagru');
    $req = $db->query( "SELECT MAX(id) as last_id FROM `image`");
    foreach($req as $item)
        $id_img = $item->last_id + 1;
    $path = "../images/{$id_img}.png";
    $url = $_POST['img_url'];
    file_put_contents($path, file_get_contents($url));
    $path = "/Camagru/images/{$id_img}.png";
    $attributes['id_user'] = $_POST['id_user_cam'];
    $attributes['path'] = $path;
    $attributes['name'] = $_POST['img_name_cam'];
    $req = $db->prepare("INSERT INTO `image` (`id_user`, `path`, `name`, `date`) VALUES (:id_user, :path, :name, NOW())", $attributes);
    header('Location: /Camagru/take_your_picture.php');
}
