<?php
use \ablin42\database;
require_once("functions.php");
if (isset($_GET['id']) && isset($_GET['token']))
{
    if (isset($_POST['submit']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        if (!check_length($_POST['password'],8, 30) || !check_length($_POST['password2'],8, 30))
        {
            echo alert_bootstrap("warning", "Your <b>password</b> has to be 8 characters minimum and 30 characters maximum!", "text-align: center;");
            return ;
        }
        if ($_POST['password'] === $_POST['password2'])
        {
            $attributes['id'] = htmlspecialchars(trim($_GET['id']));
            $db = database::getInstance('camagru');
            $req = $db->prepare("SELECT `password_token` FROM `user` WHERE `id` = :id", $attributes);
            $attributes['password'] = hash("whirlpool", $_POST['password']);
            foreach ($req as $item) {
                if ($item->password_token ===  htmlspecialchars(trim($_GET['token'])))
                {
                    $db->prepare("UPDATE `user` SET `password_token` = NULL, `password` = :password WHERE `id` = :id", $attributes);
                    echo alert_bootstrap("success", "<b>Congratulations!</b> Your password has been changed! Please, log in.", "text-align: center;");
                    header('Refresh: 3; /Camagru/');
                }
                else
                {
                    echo alert_bootstrap("danger", "<b>Invalid token!</b> Please, try again.", "text-align: center");
                    header('Refresh: 3; /Camagru/password');
                }
            }
        }
        else
            echo alert_bootstrap("danger", "<b>The passwords you entered didn't match.</b>", "text-align: center;");
    }
}
else
    header('Location: /Camagru?e=reset');