<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php
require_once("includes/header.php");
if (isset($_SESSION['logged']) && $_SESSION['logged'] === 1)
    header('Location: /Camagru/');
require_once("utils/register_user.php");
?>

<div class="container mt-5">
    <div class="wrapper col-12 p-2">
        <h5>A confirmation e-mail will be sent to you</h5>
        <div class="register-form-wrapper container col-6 p-5 mt-3 mb-3">
            <form class="my-2 my-lg-0" action="register.php" method="post">
                <?php
                $form->setLabel('Username', 'lab');
                echo $form->input('username', 'username', "form-control", "Username");
                $form->setLabel('E-mail', 'lab');
                echo $form->email('email', 'email', "form-control");
                $form->setLabel('Password', 'lab');
                echo $form->password('password', 'password', "form-control");
                $form->setLabel('Confirm your password', 'lab');
                echo $form->password('password2', 'password2', "form-control", "Confirm Password");
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
</body>
</html>