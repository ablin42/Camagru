<?php
require_once("functions.php");

if (!empty($_POST['img_url']) && !empty($_POST['filter']) && !empty($_POST['infos']))
{
    /* if decoded info are nul,use 0 for position*/
    $decodedInfos = json_decode($_POST['infos']);

    $encodedData = substr(htmlspecialchars(trim($_POST['img_url'])), 22);
    $encodedData = str_replace(' ','+', $encodedData);
    $data = base64_decode($encodedData);
    $photo = imagecreatefromstring($data);

    $filters = explode(',', $_POST['filter']);
    $filters_name = $filters;
    $i = 0;
    foreach ($filters as $item)
    {
        $filters[$i] = imagecreatefrompng("../filters/{$item}");
        $i++;
    }
    foreach ($filters as $filter)
        imagesavealpha($filter, true);

    imagealphablending($photo, true);
    $i = 0;
    foreach ($filters as $filter)
    {
        $info = get_filter_position($filters_name[$i]);
        imagecopy($photo, $filter, $decodedInfos[$i]->left, $decodedInfos[$i]->top, 0, 0, 200, 200);
        imagedestroy($filter);
        $i++;
    }

    $filename = gen_token(40);
    $filename = "../tmp/{$filename}.png";
    imagepng($photo, $filename);
    $filename = substr($filename, 3);
    echo $filename;
    imagedestroy($photo);
}