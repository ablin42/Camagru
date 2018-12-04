<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Sign up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php
require_once("includes/header.php");
if (isset($_SESSION['logged']) && $_SESSION['logged'] === 1)
    header('Location: /Camagru?e=reg');
require_once("utils/register_user.php");
?>

<div class="container mt-5 small-page-wrapper">
    <div class="wrapper col-12 p-2">
        <h5>A confirmation e-mail will be sent to you</h5>
        <div class="register-form-wrapper container col-6 p-5 mt-3 mb-3">
            <form name="register" onkeyup="validate();" class="my-2 my-lg-0" action="register.php" method="post">
                <?php
                $form->setLabel('Username', 'lab');
                $form->setInfo('Username must contain between 4 and 30 characters', "i_username", "form-info", "y");
                echo $form->input('username', 'username', "form-control", "Username", 30);
                $form->setLabel('E-mail', 'lab');
                $form->setInfo('E-mail has to be valid', "i_email","form-info", "y");
                echo $form->email('email', 'email', "form-control", "Email", 255);
                $form->setLabel('Password', 'lab');
                $form->setInfo('Password must contain between 8 and 30 characters',"i_password", "form-info", "y");
                echo $form->password('password', 'password', "form-control", "Password", 30);
                $form->setLabel('Confirm your password', 'lab');
                $form->setInfo('Password has to be the same as the one you just entered', "i_password2","form-info", "y");
                echo $form->password('password2', 'password2', "form-control", "Confirm Password", 30);
                echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in', 'Sign up');
                ?>
            </form>
        </div>
    </div>
    <div class="wrapper col-12 p-3 mt-5">
        <h5>Already have an account? You can log in at the top right corner of the page!</h5>
        <h6>Else you can go back to the main page <a href="/Camagru/">here</a></h6>
    </div>
</div>
<?php require_once("includes/footer.php");?>
<script src="js/validate.js"></script>
<script src="js/alert.js"></script>
</body>
</html>