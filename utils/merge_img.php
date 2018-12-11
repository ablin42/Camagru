<?php
require_once("functions.php");

if (!empty($_POST['img_url']) && !empty($_POST['filter']) && !empty($_POST['infos']))
{
    $img_url = $_POST['img_url'];
    $decodedInfos = json_decode($_POST['infos']);

    if (strpos($img_url, "data") !== false) {
        $encodedData = substr(htmlspecialchars(trim($img_url)), 22);
        $encodedData = str_replace(' ', '+', $encodedData);
        $data = base64_decode($encodedData);
        $photo = imagecreatefromstring($data);
    }
    else
    {
        $img_url = "../{$img_url}";
        $photo = imagecreatefrompng($img_url);
    }

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
        imagecopy($photo, $filter, $decodedInfos[$i]->left, $decodedInfos[$i]->top, 0, 0, $decodedInfos[$i]->width, $decodedInfos[$i]->height);
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