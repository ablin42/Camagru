<?php

function gen_token($length)
{
    $tab = "0123456789azertyuiopqsdfghjklmwxcvbn";
    return substr(str_shuffle(str_repeat($tab, $length)), 0, $length);
}

function alert_bootstrap($type, $message, $style = "")
{
    return "<div id=\"alert\" class=\"alert alert-{$type}\" style=\"$style\" role=\"alert\">{$message}
            <button type=\"button\" class=\"close\" onclick=\"dismissAlert(this)\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>";
}

function has_liked($db, $id_img, $id_user)
{
    $req = $db->prepare("SELECT * FROM `vote` WHERE `id_img` = :id_img AND `id_user` = :id_user", array("id_img" => $id_img, "id_user" => $id_user));
    if ($req)
        return true;
    else
        return false;
}

function mail_on_comment($db, $id_img)
{

    $req = $db->prepare("SELECT * FROM `image` LEFT JOIN `user` ON image.id_user = user.id WHERE image.id = :id", array('id' => $id_img));
    foreach ($req as $item)
    {
        if ($item->mail_notify == 1)
        {
            $subject = "Camagru - Someone commented one of your picture";
            $message = "The picture you posted at http://localhost:8080/Camagru/images.php?id={$id_img} got a comment!";
            mail($item->email, $subject, $message);
        }
    }
}

function notif_state($db, $id)
{
    $req = $db->prepare("SELECT `mail_notify` FROM `user` WHERE `id` = :id", array("id" => $id));
    foreach ($req as $item)
    {
        if ($item->mail_notify == 1)
            return true;
        else
            return false;
    }
}

function redirection_handler($error)
{
    switch ($error)
    {
        case "take";
            echo alert_bootstrap("info", "You need to be <b>logged in</b> to take and upload pictures!", "text-align: center;");
            break;
    }
}