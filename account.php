<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>

<body>
<?php
require_once("includes/header.php");
if (!isset($_SESSION['logged']) && $_SESSION['logged'] !== 1)
    header('Location: /Camagru?e=acc');
require_once("utils/modify_account.php");
?>

<div class="container mt-5 small-page-wrapper">
    <div class="wrapper col-12 p-2">
        <h1>account settings</h1>
        <div class="gallery-wrapper">
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form name="change_username" onkeyup="validate();" class="my-2 my-lg-0" action="account" method="post">
                <?php
                $form->changeSurr('div class="form-group d-inline-block col-8 pl-0"', 'div');
                $form->setLabel('Username', 'lab');
                echo $form->input('username', 'username', "form-control forms", "{$_SESSION['username']}", "30");
                $form->changeSurr('div class="form-group d-inline-block col-4"', 'div');
                echo $form->submit('submit_account', 'submit_account', 'btn btn-outline-warning btn-sign-in mb-1', 'Save');
                echo '<span id="i_username" class="form-info">Username must contain between 4 and 30 characters</span>';
                ?>
            </form>
        </div>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form name="change_email" onkeyup="validate();" class="my-2 my-lg-0" action="account" method="post">
                <?php
                $form->changeSurr('div class="form-group d-inline-block col-8 pl-0"', 'div');
                $form->setLabel('E-mail', 'lab');
                echo $form->email('email', 'email', "form-control forms", "E-mail");
                $form->changeSurr('div class="form-group d-inline-block col-4"', 'div');
                echo $form->submit('submit_email', 'submit_email', 'btn btn-outline-warning btn-sign-in mb-1', 'Save');
                echo '<span id="i_email" class="form-info">E-mail has to be valid</span>';
                ?>
            </form>
        </div>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form name="change_password" onkeyup="validate();" class="my-2 my-lg-0" action="account" method="post">
                <?php
                $form->changeSurr('div class="form-group"', 'div');
                $form->setLabel('Current password', 'lab');
                echo $form->password('currpw', 'currpw', "form-control forms", "Current password");
                $form->setLabel('New password', 'lab');
                $form->setInfo('Password must contain between 8 and 30 characters and has to be atleast alphanumeric',"i_password", "form-info", "y");
                echo $form->password('password', 'password', "form-control forms", "New password");
                $form->setLabel('Confirm your new password', 'lab');
                $form->setInfo('Password has to be the same as the one you just entered', "i_password2","form-info", "y");
                echo $form->password('password2', 'password2', "form-control forms", "Confirm your new password");
                $form->changeSurr('div class="form-group"', 'div');
                echo $form->submit('submit_password', 'submit_password', 'btn btn-outline-warning btn-sign-in mb-1', 'Save');
                ?>
            </form>
        </div>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form class="my-2 my-lg-0" action="account" method="post" style="text-align: center;">
                <input type="checkbox" id="notify" name="notify" value="true" <?php if (notif_state($db, $_SESSION['id']) === true){echo "checked";}?>><p>Notify me by mail when someone comments one of my photo</p>
                <?= $form->submit('submit_notify', 'submit_notify', 'btn btn-outline-warning btn-sign-in mb-1', 'Save');?>
            </form>
        </div>
    </div>
    </div>
</div>

<?php require_once("includes/footer.php");?>
<script src="js/validate.js"></script>
<script src="js/alert.js"></script>
</body>
</html>