<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Reset your password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php
require_once("includes/header.php");
require_once("utils/reset_password.php");
if (isset($_SESSION['logged']) && $_SESSION['logged'] === 1)
    header('Location: /Camagru?e=pw');
?>
<div class="container mt-5 small-page-wrapper">
    <div class="wrapper col-12 p-2">
        <h5>We will send you a mail to reset your password</h5>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form name="email_reset_password" onkeyup="validate();"class="my-2 my-lg-0" action="password" method="post">
                <?php
                $form->setLabel('E-mail', 'lab');
                $form->setInfo('E-mail has to be valid', "i_email","form-info", "y");
                echo $form->email('email', 'email', "form-control forms");
                echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in mb-1', 'Reset my password');
                ?>
            </form>
        </div>
    </div>
</div>


<?php require_once("includes/footer.php");?>
<script src="js/alert.js"></script>
<script src="js/validate.js"></script>
</body>
</html>