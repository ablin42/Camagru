<?php
use \ablin42\database;

if (isset($_POST['submit_cam']) && !empty($_POST['img_url']) && !empty($_POST['id_user_cam'] && !empty($_POST['infos']))
    && !empty($_POST['img_name_cam']) && !empty($_POST['filter']) && !empty($_POST['tmp_img']))
{
    if (!check_length($_POST['img_name_cam'], 1, 64))
    {
        echo alert_bootstrap("warning", "Your <b>title</b> has to be 1 character minimum and 64 characters maximum!", "text-align: center;");
        return ;
    }
    $img_url = $_POST['img_url'];
    $decodedInfos = json_decode($_POST['infos']);
    //unlink("{$_POST['tmp_img']}");

    $db = database::getInstance('camagru');
    $req = $db->query( "SELECT MAX(id) as last_id FROM `image`");
    foreach($req as $item)
        $id_img = $item->last_id + 1;
    $path = "images/{$id_img}.png";

    /*if (strpos($img_url, "data") !== false) {
        $encodedData = substr(htmlspecialchars(trim($img_url)), 22);
        $encodedData = str_replace(' ', '+', $encodedData);
        $data = base64_decode($encodedData);
        $photo = imagecreatefromstring($data);
    }
    else {
        if (strpos($img_url, ".png") == true)
            $photo = imagecreatefrompng($img_url);
        else if (strpos($img_url, ".jpg") == true || strpos($img_url, ".jpeg") == true)
            $photo = imagecreatefromjpeg($img_url);
    }

    $filters = explode(',', $_POST['filter']);
    $filters_name = $filters;
    $i = 0;
    foreach ($filters as $item)
    {
        $filters[$i] = imagecreatefrompng("filters/{$item}");
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
*/
    $photo = imagecreatefrompng($img_url);
    imagepng($photo, $path);
    imagedestroy($photo);

    $path = "/Camagru/images/{$id_img}.png";
    $attributes['id_user'] = htmlspecialchars(trim($_POST['id_user_cam']));
    $attributes['path'] = $path;
    $attributes['name'] =  strtolower(htmlspecialchars(trim($_POST['img_name_cam'])));
    $req = $db->prepare("INSERT INTO `image` (`id_user`, `path`, `name`, `date`) VALUES (:id_user, :path, :name, NOW())", $attributes);
    echo alert_bootstrap("success", "<b>Congratulations!</b> Your picture has been posted!", "text-align: center;");
}