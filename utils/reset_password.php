<?php
use \ablin42\database;
require_once("functions.php");

if (isset($_POST['submit']) && !empty($_POST['email']))
{
    $email = secure_input($_POST['email']);
    if (!check_length($email, 3, 255))
    {
        echo alert_bootstrap("warning", "Your <b>e-mail/b> has to be 3 characters minimum and 255 characters maximum!", "text-align: center;");
        return ;
    }
    $db = database::getInstance('camagru');
    $attributes1['email'] = $email;

    $req = $db->prepare("SELECT `id` FROM `user` WHERE `email` = :email", $attributes1);
    if ($req)
    {
        $user_id = null;
        foreach ($req as $item)
            $user_id = $item->id;
        if ($user_id === null)
        {
            echo alert_bootstrap("danger", "<b>Error:</b> Something went wrong, please try again.", "text-align:center;");
            return;
        }
        $attributes2['password_token'] = gen_token(128);
        $attributes2['user_id'] = $user_id;
        $token = $attributes2['password_token'];

        $db->prepare("UPDATE `user` SET `password_token` = :password_token WHERE `id` = :user_id", $attributes2);
        mail($email, "Reset your password at Camagru", "In order to set a new password, please click this link: \n\nhttp://localhost:8080/Camagru/reset?id=$user_id&token=$token");
        echo alert_bootstrap("info", "An <b>e-mail</b> was sent to your adress, please follow the instructions we sent you.", "text-align:center;");
    }
    else
        echo alert_bootstrap("danger", "<b>Error:</b> Something went wrong, please try again.", "text-align:center;");
}