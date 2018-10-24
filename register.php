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
<?php require_once("includes/header.php");?>

<div class="container mt-4">
    <div class="register-wrapper col-12 p-1">

        <h5>A confirmation e-mail will be sent to you</h5>
        <div class="register-form-wrapper container col-6 p-5 mt-3 mb-3">
            <form class="my-2 my-lg-0" action="login.php" method="post">
                <?php
                echo $form->label('Username', 'username', 'lab');
                echo $form->input('username', 'username', "form-control");
                echo $form->label('Email', 'email', 'lab');
                echo $form->input('email', 'email', "form-control");
                echo $form->label('Password', 'password', 'lab');
                echo $form->password('password', 'password', "form-control");
                echo $form->label('Re-enter your password', 'password2', 'lab');
                echo $form->password('password2', 'password2', "form-control");
                echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in', 'Sign up');
                ?>
            </form>
        </div>
        <h3>add a div under that that ask the user if he wants to log in instead or be taken back to the home page</h3>
    </div>
</div>
<?php require_once("includes/footer.php");?>
</body>
</html>