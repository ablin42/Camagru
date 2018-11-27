<?php

if (!empty($_POST['img_url']) && !empty($_POST['filter']))
{
    $encodedData = substr($_POST['img_url'], 22);
    $encodedData = str_replace(' ','+', $encodedData);
    $data = base64_decode($encodedData);
    $photo = imagecreatefromstring($data);

    $filter = imagecreatefrompng("../filters/{$_POST['filter']}");

    imagealphablending($photo, true);
    imagesavealpha($filter, true);
    imagecopy($photo, $filter, 0, 0, 0, 0, 200, 219);//values to change for each different filter

    //header('Content-Type: image/png');
    //imagepng($photo);
    imagepng($photo, '../tmp/merge_photo.png');
    echo 'tmp/merge_photo.png';
    imagedestroy($photo);
    imagedestroy($filter);
}