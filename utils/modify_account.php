<?php
use \ablin42\database;
use \ablin42\alertHtml;

$alertHtml = new alertHtml();
$db = database::getInstance('camagru');

if (isset($_POST['submit_account']) && !empty($_POST['username']))
{
    $attributes['newusername'] = $_POST['username'];
    $req = $db->prepare("SELECT * FROM `user` WHERE `username` = :newusername", $attributes);
    if ($req)
    {
        echo $alertHtml->alert("warning", "The <b>username</b> you entered is already taken, <b>please pick another one.</b>", "text-align: center;");
        return ;
    }
    else
    {
        $attributes['currusername'] = $_SESSION['username'];
        $req = $db->prepare("UPDATE `user` SET `username` = :newusername WHERE `username` = :currusername", $attributes);
        $_SESSION['username'] = $attributes['newusername'];
        echo $alertHtml->alert("success", "<b>Congratulations !</b> You successfully changed your username!", "text-align: center;");
        return ;
    }
}

if (isset($_POST['submit_email']) && !empty($_POST['email']))
{
    $attributes['newemail'] = hash('whirlpool', $_POST['email']);
    $req = $db->prepare("SELECT * FROM `user` WHERE `email` = :newemail AND `confirmed_token` != NULL", $attributes);
    if ($req)
    {
        echo $alertHtml->alert("warning", "The <b>e-mail</b> you entered is already taken, <b>please pick another one.</b>", "text-align: center;");
        return ;
    }
    else
    {
        $attributes['username'] = $_SESSION['username'];
        $attributes['mail_token'] = gen_token(128);
        $token = $attributes['mail_token'];
        $user_id = $attributes['username'];

        $req = $db->prepare("UPDATE `user` SET `email` = :newemail, `mail_token` = :mail_token, confirmed_token = NULL WHERE `username` = :username", $attributes);
        mail($_POST['email'], "Confirm your account at Camagru","In order to confirm your account, please click this link: \n\nhttp://localhost:8080/Camagru/utils/confirm.php?id=$user_id&token=$token");
        echo $alertHtml->alert("success", "<b>Congratulations !</b> You successfully changed your e-mail! Please <b>confirm your email</b> by clicking the link we sent at your e-mail address", "text-align: center;");
        return ;
    }
}

if (isset($_POST['submit_password']) && !empty($_POST['currpw']) && !empty($_POST['newpw']) && !empty($_POST['newpw2']))
{
    $attributes['username'] = $_SESSION['username'];
    $req = $db->prepare("SELECT * FROM `user` WHERE `username` = :username", $attributes);
    if (!$req)
    {
        echo $alertHtml->alert("danger", "Error: Please try again.", "text-align: center;");
        return ;
    }
    else
    {
        if ($_POST['newpw'] === $_POST['newpw2'])
        {
            $currpw = hash('whirlpool', $_POST['currpw']);
            foreach ($req as $item)
            {
                if ($item->password !== $currpw)
                {
                    echo $alertHtml->alert("danger", "<b>Error: This is not your current password.</b>", "text-align: center;");
                    return;
                }
            }
            $attributes['newpw'] = hash('whirlpool', $_POST['newpw']);
            $req = $db->prepare("UPDATE `user` SET `password` = :newpw WHERE `username` = :username", $attributes);
            echo $alertHtml->alert("success", "<b>Congratulations !</b> You successfully changed your password!", "text-align: center;");
            return;
        }
        else
            echo $alertHtml->alert("danger", "<b>The passwords you entered didn't match.</b>", "text-align: center;");
    }
}