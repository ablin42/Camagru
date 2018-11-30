<?php
require_once("functions.php");

if (!empty($_POST['img_url']) && !empty($_POST['filter']))
{
    $encodedData = substr($_POST['img_url'], 22);
    $encodedData = str_replace(' ','+', $encodedData);
    $data = base64_decode($encodedData);
    $photo = imagecreatefromstring($data);
    $filter = imagecreatefrompng("../filters/{$_POST['filter']}");

    $info = get_filter_position($_POST['filter']);

    imagealphablending($photo, true);
    imagesavealpha($filter, true);
    imagecopy($photo, $filter, $info['dst_x'], $info['dst_y'], 0, 0, $info['src_w'], $info['src_h']);

    $filename = gen_token(40);
    $filename = "../tmp/{$filename}.png";
    imagepng($photo, $filename);
    $filename = substr($filename, 3);
    echo $filename;
    imagedestroy($photo);
    imagedestroy($filter);
}