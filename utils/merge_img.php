<?php

if (!empty($_POST['img_url']) && !empty($_POST['filter']))
{
    $photo = imagecreatefrompng("../images/7.png");
    $filter = imagecreatefrompng("../filters/{$_POST['filter']}");

    imagealphablending($photo, false);
    imagesavealpha($photo, true);

    imagecopymerge($photo, $filter, 0, 0, 0, 0, 100, 100, 100);

    header('Content-Type: image/png');
    imagepng($photo);
}