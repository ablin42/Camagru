<?php
use \ablin42\database;
require_once("functions.php");

if (isset($_POST['submit']) && !empty($_POST['comment']) && !empty($_POST['id_img']))
{
        $db = database::getInstance('camagru');
        $attributesc = array();
        $attributesc['content'] = $_POST['comment'];
        $attributesc['id_img'] = $_POST['id_img'];
        $attributes2['username'] = $_SESSION['username'];

        //fetch id_user with query or session + fetch id img with prefilled form
        $req = $db->prepare("SELECT * FROM `user` WHERE `username` = :username", $attributes2);
        if ($req)
        {
            foreach ($req as $item)
                $attributesc['id_user'] = $item->id;
        }
        else
            echo alert_bootstrap("danger", "<b>User</b> does not exist!", "text-align: center;");
        $req = $db->prepare("INSERT INTO `comment` (`id_img`, `id_user`, `content`, `date`) VALUES (:id_img, :id_user, :content, NOW())", $attributesc);
        mail_on_comment($db, $_POST['id_img']);
        echo alert_bootstrap("success", "Your comment has been posted!", "text-align: center;");
        header ('Refresh: 3;');
}
