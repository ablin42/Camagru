<?php
use \ablin42\database;

if (isset($_POST['submit']) && !empty($_POST['img_name']) && !empty($_POST['id_user']) && !empty($_POST['MAX_FILE_SIZE']))
{
    if($_FILES['picture']['error'] > 0)
    {
        echo alert_bootstrap("danger", "An <b>error</b> occured during the upload! Please, try again.", "text-align: center;");
        return ;
    }

    if($_FILES['picture']['size'] > $_POST['MAX_FILE_SIZE'])
    {
        echo alert_bootstrap("danger", "<b>Error:</b> The file you select is too big (> 2MB).", "text-align: center;");
        return ;
    }

    $valid_extensions = array('jpg' , 'jpeg' , 'gif' , 'png');
    $extension_upload = strtolower(substr(strrchr($_FILES['picture']['name'],'.'),1));
    if (!in_array($extension_upload, $valid_extensions))
    {
        echo alert_bootstrap("danger", "<b>Error:</b> File extension is not valid! <b>(Extension authorized: jpg, jpeg, gif, png)</b>", "text-align: center;");
        return ;
    }

    $image_size = getimagesize($_FILES['picture']['tmp_name']);
    $maxwidth = 1000;
    $maxheight = 600;
    if ($image_size[0] > $maxwidth OR $image_size[1] > $maxheight) {
        echo alert_bootstrap("danger", "<b>Error:</b> File dimensions aren't valid! <b>(Max width: 1000/Max height: 600)</b>", "text-align: center;");
        return ;
    }

    $db = database::getInstance('camagru');
    $req = $db->query( "SELECT MAX(id) as last_id FROM `image`");
    foreach($req as $item)
        $id_img = $item->last_id + 1;
    $path = "images/{$id_img}.{$extension_upload}";
    move_uploaded_file($_FILES['picture']['tmp_name'], $path);
    $path = "/Camagru/images/{$id_img}.{$extension_upload}";
    $attributes['id_user'] = $_POST['id_user'];
    $attributes['path'] = $path;
    $attributes['name'] = $_POST['img_name'];
    $req = $db->prepare("INSERT INTO `image` (`id_user`, `path`, `name`, `date`) VALUES (:id_user, :path, :name, NOW())", $attributes);
    echo alert_bootstrap("success", "<b>Congratulations!</b> Your picture has been posted!", "text-align: center;");
}
