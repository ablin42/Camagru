<?php
use \ablin42\database;
require_once("functions.php");
if (isset($_POST['submit']) && !empty($_POST['email']))
{
    if (!check_length($_POST['email'], 3, 255))
    {
        echo alert_bootstrap("warning", "Your <b>e-mail/b> has to be 3 characters minimum and 255 characters maximum!", "text-align: center;");
        return ;
    }
    $db = database::getInstance('camagru');
    $attributes1['email'] = htmlspecialchars(trim($_POST['email']));

    $req = $db->prepare("SELECT `id` FROM `user` WHERE `email` = :email", $attributes1);
    foreach ($req as $item)
        $user_id = $item->id;
    $attributes2['password_token'] = gen_token(128);
    $attributes2['user_id'] = $user_id;
    $token = $attributes2['password_token'];

    $db->prepare("UPDATE `user` SET `password_token` = :password_token WHERE `id` = :user_id", $attributes2);
    mail($_POST['email'], "Reset your password at Camagru","In order to set a new password, please click this link: \n\nhttp://localhost:8080/Camagru/reset?id=$user_id&token=$token");
    echo alert_bootstrap("info", "An <b>e-mail</b> was sent to your adress, please follow the instructions we sent you.", "text-align:center;");
}