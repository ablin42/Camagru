<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php
require_once("includes/header.php");
require_once("utils/reset_password.php");
?>
<div class="container mt-5">
    <div class="wrapper col-12 p-2">
        <h5>Account settings</h5>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form class="my-2 my-lg-0" action="password.php" method="post">
                <?php
                $form->setLabel('E-mail', 'lab');
                echo $form->email('email', 'email', "form-control forms");
                echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in mb-1', 'Reset my password');
                ?>
            </form>
        </div>
    </div>
</div>


<?php require_once("includes/footer.php");?>
<script src="js/alert.js"></script>
</body>
</html>