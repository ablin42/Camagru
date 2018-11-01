<?php
use \ablin42\database;
use \ablin42\alertHtml;
require_once("functions.php");
if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email']))
{
    $alertHtml = new alertHtml();
    if ($_POST['password'] === $_POST['password2'])
    {
        $db = new database('camagru', 'localhost', 'root', 'root42');
        $attributes = array();
        $attributes['username'] = $_POST['username'];

        $req = $db->prepare("SELECT * FROM `user` WHERE `username` = :username", $attributes);
        if ($req)
        {
            echo $alertHtml->alert("warning", "The <b>username</b> you entered is already taken, <b>please pick another one.</b>", "text-align: center;");
            return ;
        }
        $attributes['email'] = hash('whirlpool', $_POST['email']);
        $attributes['password'] = hash('whirlpool', $_POST['password']);

        $req = $db->query("SELECT * FROM `user` WHERE `email` = '". $attributes['email'] ."' AND `confirmed_token` != NULL");
        if ($req)
        {
            echo $alertHtml->alert("warning" , "The <b>e-mail</b> you entered is already taken by a verified account, <b>please pick another one.</b>", "text-align: center;");
            return ;
        }
        $attributes['mail_token'] = gen_token(128);
        $token = $attributes['mail_token'];
        $user_id = $attributes['username'];

        $db->prepare("INSERT INTO `user` (`username`, `password`, `email`, `mail_token`) VALUES (:username, :password, :email, :mail_token)", $attributes);
        echo $_POST['email'];
        if (mail($_POST['email'], "Confirm your account at Camagru","In order to confirm your account, please click this link: \n\nhttp://localhost:8080/Camagru/utils/confirm.php?id=$user_id&token=$token"))
            echo $alertHtml->alert("success" , "Success!", "text-align: center;");
        else
            echo $alertHtml->alert("danger" , "Error!", "text-align: center;");
        //$_SESSION['username'] = $attributes['username'];
       // $_SESSION['logged'] = 1;
        //echo $alertHtml->alert("success", "<b>Your account has been successfully created!</b> Redirecting you to the main page...", "text-align: center;");
        //header ('Refresh: 3; /Camagru/');
    }
    else
        echo $alertHtml->alert("danger", "<b>The passwords you entered didn't match.</b>", "text-align: center;");
}
