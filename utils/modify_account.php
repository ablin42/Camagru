<?php
use \ablin42\database;
require_once("functions.php");
$db = database::getInstance('camagru');

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_POST['submit_account']) && !empty($_POST['username']))
    {
        $username = secure_input($_POST['username']);
        if (!check_length($username, 4, 30)) {
            echo alert_bootstrap("warning", "Your <b>username</b> has to be 4 characters minimum and 30 characters maximum!", "text-align: center;");
            return;
        }
        $attributes['newusername'] = $username;
        $req = $db->prepare("SELECT * FROM `user` WHERE `username` = :newusername", $attributes);
        if ($req) {
            echo alert_bootstrap("warning", "The <b>username</b> you entered is already taken, <b>please pick another one.</b>", "text-align: center;");
            return;
        } else {
            $attributes['user_id'] = secure_input($_SESSION['id']);
            $req = $db->prepare("UPDATE `user` SET `username` = :newusername WHERE `id` = :user_id", $attributes);
            $_SESSION['username'] = $username;
            echo alert_bootstrap("success", "<b>Congratulations !</b> You successfully changed your username!", "text-align: center;");
            return;
        }
    }

    if (isset($_POST['submit_email']) && !empty($_POST['email']))
    {
        $email = secure_input($_POST['email']);
        $pattern_email = "/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
        if (!check_length($email, 3, 255) || !preg_match($pattern_email, $email))
        {
            echo alert_bootstrap("warning", "Your <b>e-mail</b> has to be 3 characters minimum and 255 characters maximum! (and valid!)", "text-align: center;");
            return;
        }
        $attributes['newemail'] = $email;
        $req = $db->prepare("SELECT * FROM `user` WHERE `email` = :newemail", $attributes);
        if ($req) {
            echo alert_bootstrap("warning", "The <b>e-mail</b> you entered is already taken, <b>please pick another one.</b>", "text-align: center;");
            return;
        } else {
            $attributes['user_id'] = secure_input($_SESSION['id']);
            $token = gen_token(128);
            $attributes['mail_token'] = $token;
            $username = secure_input($_SESSION['id']);

            $req = $db->prepare("UPDATE `user` SET `email` = :newemail, `mail_token` = :mail_token, confirmed_token = NULL WHERE `id` = :user_id", $attributes);
            $subject = "Confirm your account at Camagru";
            $message = "In order to confirm your account, please click this link: \n\nhttp://localhost:8080/Camagru/utils/confirm.php?id=$username&token=$token";
            var_dump($message);
            mail($email, $subject, $message);
            echo alert_bootstrap("success", "<b>Congratulations !</b> You successfully changed your e-mail! Please <b>confirm your email</b> by clicking the link we sent at your e-mail address", "text-align: center;");
            return;
        }
    }

    if (isset($_POST['submit_password']) && !empty($_POST['currpw']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        $currpassword = $_POST['currpw'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $pattern_pw = "/^(((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(.{8,})/";
        if (!check_length($password, 8, 30) || !check_length($password2, 8, 30) || (!preg_match($pattern_pw, $password)))
        {
            echo alert_bootstrap("warning", "Your <b>password</b> has to be 8 characters, 30 characters maximum and has to be atleast alphanumeric!", "text-align: center;");
            return;
        }
        $attributes['user_id'] = secure_input($_SESSION['id']);
        $req = $db->prepare("SELECT * FROM `user` WHERE `id` = :user_id", $attributes);
        if (!$req)
        {
            echo alert_bootstrap("danger", "Error: User not found. Please try again. If the error persist try disconnecting and reconnecting", "text-align: center;");
            return;
        }
        else
        {
            if ($password === $password2)
            {
                $currpw = hash('whirlpool', $currpassword);
                foreach ($req as $item)
                {
                    if ($item->password !== $currpw)
                    {
                        echo alert_bootstrap("danger", "<b>Error:</b> This is not your current password.", "text-align: center;");
                        return;
                    }
                }
                $attributes['password'] = hash('whirlpool', $password);
                $req = $db->prepare("UPDATE `user` SET `password` = :password WHERE `id` = :user_id", $attributes);
                echo alert_bootstrap("success", "<b>Congratulations !</b> You successfully changed your password!", "text-align: center;");
                return;
            }
            else
                echo alert_bootstrap("danger", "<b>Error:</b> The passwords you entered didn't match.", "text-align: center;");
        }
    }


    if (isset($_POST['submit_notify'])) {
        if (isset($_POST['notify'])) {
            $req = $db->prepare("UPDATE `user` SET `mail_notify` = 1 WHERE `id` = :id", array('id' => $_SESSION['id']));
            echo alert_bootstrap("info", "You <b>enabled</b> mail notifications!", "text-align: center;");
        } else {
            $req = $db->prepare("UPDATE `user` SET `mail_notify` = 0 WHERE `id` = :id", array('id' => $_SESSION['id']));
            echo alert_bootstrap("info", "You <b>disabled</b> mail notifications!", "text-align: center;");
        }
    }
}