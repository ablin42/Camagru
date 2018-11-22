<?php
session_start();
use \ablin42\autoloader;
use \ablin42\database;

require ("../class/autoloader.php");
require ("functions.php");
autoloader::register();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $db = database::getInstance('camagru');
    $req = $db->prepare("SELECT * FROM `image` WHERE `id` = :id", array("id" => $_POST['id']));
    if ($req)
    {
        if (!has_liked($db, $_POST['id'], $_POST['u']))
        {
            $db->prepare("INSERT INTO `vote` (`id_img`, `id_user`) VALUES (:id_img, :id_user)", array("id_img" => $_POST['id'], "id_user" => $_POST['u']));
            $req = $db->prepare("SELECT count(id) as count FROM `vote` WHERE `id_img` = :id_img", array("id_img" => $_POST['id']));
            $like = 0;
            foreach ($req as $item)
            {
                $like = $item->count;
                break;
            }
            $db->prepare("UPDATE `image` SET `nb_like` = :like WHERE `id` = :id_img", array("like" => $like, "id_img" => $_POST['id']));
        }
        else
        {
            $db->prepare("DELETE FROM `vote` WHERE `id_img` = :id_img AND `id_user` = :id_user", array("id_img" => $_POST['id'], "id_user" => $_POST['u']));
            $req = $db->prepare("SELECT count(id) as count FROM `vote` WHERE `id_img` = :id_img", array("id_img" => $_POST['id']));
            $like = 0;
            foreach ($req as $item)
            {
                $like = $item->count;
                break;
            }
            $db->prepare("UPDATE `image` SET `nb_like` = :like WHERE `id` = :id_img", array("like" => $like, "id_img" => $_POST['id']));
        }
    }
}?>
<script>
    var $nb_like = document.getElementById("nb_like");
    $nb_like.innerText = <?= $like ?>;
</script>