<?php
use \ablin42\database;
require_once("functions.php");

if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email']))
{
    if ($_POST['password'] === $_POST['password2'])
    {
        $db = database::getInstance('camagru');
        $attributes = array();
        $attributes['username'] = htmlspecialchars(trim($_POST['username']));

        if (!check_length($_POST['username'], 4, 30))
        {
            echo alert_bootstrap("warning", "Your <b>username</b> has to be 4 characters minimum and 30 characters maximum!", "text-align: center;");
            return ;
        }
        else if (!check_length($_POST['password'],8, 30) || !check_length($_POST['password2'],8, 30))
        {
            echo alert_bootstrap("warning", "Your <b>password</b> has to be 8 characters minimum and 30 characters maximum!", "text-align: center;");
            return ;
        }
        else if (!check_length($_POST['email'], 3, 255))
        {
            echo alert_bootstrap("warning", "Your <b>e-mail/b> has to be 3 characters minimum and 255 characters maximum!", "text-align: center;");
            return ;
        }

        $req = $db->prepare("SELECT * FROM `user` WHERE `username` = :username", $attributes);
        if ($req)
        {
            echo alert_bootstrap("warning", "The <b>username</b> you entered is already taken, <b>please pick another one.</b>", "text-align: center;");
            return ;
        }
        $attributes['email'] = htmlspecialchars(trim($_POST['email']));
        $attributes['password'] = hash('whirlpool', $_POST['password']);

        $req = $db->prepare("SELECT * FROM `user` WHERE `email` = :email AND `confirmed_token` != 'NULL'", array('email' => $attributes['email']));
        if ($req)
        {
            echo alert_bootstrap("warning" , "The <b>e-mail</b> you entered is already taken by a verified account, <b>please pick another one.</b>", "text-align: center;");
            return ;
        }
        $attributes['mail_token'] = gen_token(128);
        $token = $attributes['mail_token'];
        $user_id = $attributes['username'];

        $db->prepare("INSERT INTO `user` (`username`, `password`, `email`, `mail_token`) VALUES (:username, :password, :email, :mail_token)", $attributes);
        $subject = "Confirm your account at Camagru";
        $message = "In order to confirm your account, please click this link: \n\nhttp://localhost:8080/Camagru/utils/confirm.php?id=$user_id&token=$token";
        mail($_POST['email'], $subject, $message);
        $_SESSION['username'] = $attributes['username'];
        $_SESSION['logged'] = 1;
        $req = $db->prepare("SELECT `id` FROM `user` WHERE `username` = :username", array('username' => $_POST['username']));
        if ($req)
            foreach ($req as $item)
                $_SESSION['id'] = $item->id;
        echo alert_bootstrap("success", "<b>Your account has been successfully created!</b> Please <b>confirm your email</b> by clicking the link we sent at your e-mail address", "text-align: center;");
        header ('Refresh: 5; /Camagru/');
    }
    else
        echo alert_bootstrap("danger", "<b>The passwords you entered didn't match.</b>", "text-align: center;");
}
