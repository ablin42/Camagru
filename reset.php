<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - New password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>

<body>
<?php
require_once("includes/header.php");
require_once("utils/password_update.php");
?>
<div class="container mt-5 small-page-wrapper">
    <div class="wrapper col-8 offset-2 p-2">
        <h1>reset your password</h1>
        <h5>you will need to log in after changing your password</h5>
        <div class="container col-8 p-3 mt-3 mb-3">
            <form name="reset_password" onkeyup="validate();" class="register-form col-10 offset-1 my-2 my-lg-0" action="reset.php?id=<?php echo "{$_GET['id']}&token={$_GET['token']}";?>" method="post">
                <?php
                $form->setLabel('Password', 'lab');
                $form->setInfo('Password must contain between 8 and 30 characters and has to be atleast alphanumeric',"i_password", "form-info", "y");
                echo $form->password('password', 'password', "form-control", "********");
                $form->setLabel('Confirm your password', 'lab');
                $form->setInfo('Password has to be the same as the one you just entered', "i_password2","form-info", "y");
                echo $form->password('password2', 'password2', "form-control", "********");
                echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in mb-1', 'Set new password');
                ?>
            </form>
        </div>
    </div>
    <div class="col-12 p-3 mt-5">
        <h5>Make sure to remember your password this time!</h5>
    </div>
</div>
<script src="js/validate.js"></script>
<script src="js/alert.js"></script>
<?php require_once("includes/footer.php");?>
</body>
</html>