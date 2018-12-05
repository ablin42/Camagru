<?php
use \ablin42\database;

if (isset($_POST['submit_cam']) && !empty($_POST['img_url']) && !empty($_POST['id_user_cam'])
    && !empty($_POST['img_name_cam']) && !empty($_POST['filter']) && !empty($_POST['tmp_img']))
{
    if (!check_length($_POST['img_name_cam'], 1, 64))
    {
        echo alert_bootstrap("warning", "Your <b>title</b> has to be 1 character minimum and 64 characters maximum!", "text-align: center;");
        return ;
    }
    unlink("{$_POST['tmp_img']}");
    $db = database::getInstance('camagru');
    $req = $db->query( "SELECT MAX(id) as last_id FROM `image`");
    foreach($req as $item)
        $id_img = $item->last_id + 1;
    $path = "images/{$id_img}.png";

    $encodedData = substr($_POST['img_url'], 22);
    $encodedData = str_replace(' ','+', $encodedData);
    $data = base64_decode($encodedData);
    $photo = imagecreatefromstring($data);
    $filter = imagecreatefrompng("filters/{$_POST['filter']}");
    imagealphablending($photo, true);
    imagesavealpha($filter, true);

    $info = get_filter_position(htmlspecialchars(trim($_POST['filter'])));

    imagecopy($photo, $filter, $info['dst_x'], $info['dst_y'], 0, 0, $info['src_w'], $info['src_h']);
    imagepng($photo, $path);
    imagedestroy($photo);
    imagedestroy($filter);

    $path = "/Camagru/images/{$id_img}.png";
    $attributes['id_user'] = htmlspecialchars(trim($_POST['id_user_cam']));
    $attributes['path'] = $path;
    $attributes['name'] =  htmlspecialchars(trim($_POST['img_name_cam']));
    $req = $db->prepare("INSERT INTO `image` (`id_user`, `path`, `name`, `date`) VALUES (:id_user, :path, :name, NOW())", $attributes);
    echo alert_bootstrap("success", "<b>Congratulations!</b> Your picture has been posted!", "text-align: center;");
}