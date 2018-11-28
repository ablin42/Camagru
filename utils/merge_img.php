<?php
require_once("functions.php");

if (!empty($_POST['img_url']) && !empty($_POST['filter']))
{
    $encodedData = substr($_POST['img_url'], 22);
    $encodedData = str_replace(' ','+', $encodedData);
    $data = base64_decode($encodedData);
    $photo = imagecreatefromstring($data);
    $filter = imagecreatefrompng("../filters/{$_POST['filter']}");

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

    imagealphablending($photo, true);
    imagesavealpha($filter, true);
    imagecopy($photo, $filter, $dst_x, $dst_y, 0, 0, $src_w, $src_h);

    $filename = gen_token(40);
    $filename = "../tmp/{$filename}.png";
    imagepng($photo, $filename);
    $filename = substr($filename, 3);
    echo $filename;
    imagedestroy($photo);
    imagedestroy($filter);
}