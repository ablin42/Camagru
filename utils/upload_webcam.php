<?php

use \ablin42\autoloader;
use \ablin42\database;

require ("../class/autoloader.php");
autoloader::register();

if (isset($_POST['submit_cam']) && !empty($_POST['img_url']) && !empty($_POST['id_user_cam']) && !empty($_POST['img_name_cam']) && !empty($_POST['filter']))
{

    $db = database::getInstance('camagru');
    $req = $db->query( "SELECT MAX(id) as last_id FROM `image`");
    foreach($req as $item)
        $id_img = $item->last_id + 1;
    $path = "../images/{$id_img}.png";

    $encodedData = substr($_POST['img_url'], 22);
    $encodedData = str_replace(' ','+', $encodedData);
    $data = base64_decode($encodedData);
    $photo = imagecreatefromstring($data);
    $filter = imagecreatefrompng("../filters/{$_POST['filter']}");
    imagealphablending($photo, true);
    imagesavealpha($filter, true);
    imagecopy($photo, $filter, 0, 0, 0, 0, 200, 219);
    imagepng($photo, $path);
    imagedestroy($photo);
    imagedestroy($filter);

    $path = "/Camagru/images/{$id_img}.png";
    $attributes['id_user'] = $_POST['id_user_cam'];
    $attributes['path'] = $path;
    $attributes['name'] = $_POST['img_name_cam'];
    $req = $db->prepare("INSERT INTO `image` (`id_user`, `path`, `name`, `date`) VALUES (:id_user, :path, :name, NOW())", $attributes);
    header('Location: /Camagru/take_your_picture.php');
}