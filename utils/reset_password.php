<?php
use \ablin42\database;
require_once("functions.php");
if (isset($_POST['submit']) && !empty($_POST['email']))
{

    $db = database::getInstance('camagru');
    $attributes1['email'] = hash("whirlpool", $_POST['email']);

    $req = $db->prepare("SELECT `id` FROM `user` WHERE `email` = :email", $attributes1);
    foreach ($req as $item)
        $user_id = $item->id;
    $attributes2['password_token'] = gen_token(128);
    $attributes2['user_id'] = $user_id;
    $token = $attributes2['password_token'];

    $db->prepare("UPDATE `user` SET `password_token` = :password_token WHERE `id` = :user_id", $attributes2);
    mail($_POST['email'], "Reset your password at Camagru","In order to set a new password, please click this link: \n\nhttp://localhost:8080/Camagru/new_password.php?id=$user_id&token=$token");
}
