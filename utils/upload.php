<?php

use \ablin42\autoloader;
use \ablin42\database;

require ("../class/autoloader.php");
autoloader::register();

if (isset($_POST['submit']) && !empty($_POST['img_name']) && !empty($_POST['id_user']) && !empty($_POST['MAX_FILE_SIZE']))
{
    if($_FILES['picture']['error'] > 0) echo "An error occured during the upload";
    if($_FILES['picture']['size'] > $_POST['MAX_FILE_SIZE']) echo "The file is too big";

    $valid_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
    $extension_upload = strtolower(substr(strrchr($_FILES['picture']['name'],'.'),1));
    if (!in_array($extension_upload, $valid_extensions) ) echo "Extension is not valid";

  /*  $image_size = getimagesize($_FILES['picture']['tmp_name']); image dimensions tests
    $maxwidth = 1000;
    $maxheight = 650;
    if ($image_size[0] > $maxwidth OR $image_size[1] > $maxheight) $erreur = "The image you tried to upload is too big.";*/

    $db = database::getInstance('camagru');
    $req = $db->query( "SELECT MAX(id) as last_id FROM `image`");
    foreach($req as $item)
        $id_img = $item->last_id + 1;

    $path = "../images/{$id_img}.{$extension_upload}";
    move_uploaded_file($_FILES['picture']['tmp_name'], $path);

    $path = "/Camagru/images/{$id_img}.{$extension_upload}";
    $attributes['id_user'] = $_POST['id_user'];
    $attributes['path'] = $path;
    $attributes['name'] = $_POST['img_name'];
    $req = $db->prepare("INSERT INTO `image` (`id_user`, `path`, `name`, `date`) VALUES (:id_user, :path, :name, NOW())", $attributes);
    header('Location: /Camagru/take_your_picture.php');
}
