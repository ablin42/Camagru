<?php

function gen_token($length)
{
    $tab = "0123456789azertyuiopqsdfghjklmwxcvbn";
    return substr(str_shuffle(str_repeat($tab, $length)), 0, $length);
}

function alert_bootstrap($type, $message, $style = "")
{
    return "<div class=\"alert alert-{$type}\" style=\"$style\" role=\"alert\">{$message}</div>";
}

function has_liked($db, $id_img, $id_user)
{
    $req = $db->prepare("SELECT * FROM `vote` WHERE `id_img` = :id_img AND `id_user` = :id_user", array("id_img" => $id_img, "id_user" => $id_user));
    if ($req)
        return true;
    else
        return false;
}