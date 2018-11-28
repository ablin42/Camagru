<?php

use \ablin42\autoloader;
use \ablin42\database;

require ("../class/autoloader.php");
autoloader::register();

if (isset($_POST['submit_cam']) && !empty($_POST['img_url']) && !empty($_POST['id_user_cam'])
    && !empty($_POST['img_name_cam']) && !empty($_POST['filter']) && !empty($_POST['tmp_img']))
{
    unlink("../{$_POST['tmp_img']}");
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

    $src_w = 200;
    $src_h = 200;
    $dst_x = 0;
    $dst_y = 0;

    if ($_POST['filter'] === "brak.png" || $_POST['filter'] === "bonta.png")
    {
        $src_w = 500;
        $src_h = 500;
    }
    else if ($_POST['filter'] === "solomonk.png" || $_POST['filter'] === "rdv.png" || $_POST['filter'] === "comte.png")
    {
        $dst_x = 200;
        $dst_y = 0;
    }
    else if ($_POST['filter'] === "ivoire.png" || $_POST['filter'] === "ebene.png" || $_POST['filter'] === "ocre.png")
    {
        $dst_x = 400;
        $dst_y = 150;
    }
    else if ($_POST['filter'] === "emeraude.png" || $_POST['filter'] === "turquoise.png" || $_POST['filter'] === "pourpre.png")
    {
        $dst_x = 0;
        $dst_y = 150;
    }

    imagecopy($photo, $filter, $dst_x, $dst_y, 0, 0, $src_w, $src_h);
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