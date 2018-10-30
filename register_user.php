<?php
use \ablin42\database;
use \ablin42\alertHtml;
use \ablin42\session;
if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email']))
{
    $alertHtml = new alertHtml();
    if ($_POST['password'] === $_POST['password2'])
    {
        $db = new database('camagru', 'localhost', 'root', '');

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
        $req = $db->query("SELECT * FROM `user` WHERE `email` = '". $attributes['email'] ."' AND `confirmed` = 1");
        if ($req)
        {
            echo $alertHtml->alert("warning" , "The <b>e-mail</b> you entered is already taken by a verified account, <b>please pick another one.</b>", "text-align: center;");
            return ;
        }
        $db->prepare("INSERT INTO `user` (`username`, `password`, `email`) VALUES (:username, :password, :email)", $attributes);
        $_SESSION['username'] = $attributes['username'];
        $_SESSION['logged'] = 1;
        $session = session::getInstance();
        var_dump($session->getInfo());
        echo $alertHtml->alert("success", "<b>Your account has been successfully created!</b> Redirecting you to the main page...", "text-align: center;");
        header ('Refresh: 3; index.php');
    }
    else
        echo $alertHtml->alert("danger", "<b>The passwords you entered didnt match.</b>", "text-align: center;");
}
