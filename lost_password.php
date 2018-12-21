<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Reset your password</title>
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
if (isset($_SESSION['logged']) && $_SESSION['logged'] === 1)
    header('Location: /Camagru/?e=pw');
?>
<div class="container mt-5 small-page-wrapper">
    <div class="wrapper col-8 offset-2 p-2">
        <h1>enter your e-mail</h1>
        <h5>we will send you a mail to reset your password</h5>
        <div class="register-form-wrapper container col-8 p-3 mt-3 mb-3">
            <form onsubmit="return submitForm(this, 'mail_password_token');" name="mail_password_token" onkeyup="validate();" class="my-2 my-lg-0" action="" method="post">
                <?php
                $form->setLabel('E-mail', 'lab');
                $form->setInfo('E-mail has to be valid', "i_email","form-info", "y");
                echo $form->email('email', 'email', "form-control forms", "ablin42@byom.de");
                echo $form->submit('submit_mail_password_token', 'submit_mail_password_token', 'btn btn-outline-warning btn-sign-in mb-1', 'Reset my password');
                ?>
            </form>
        </div>
    </div>
    <div class="col-12 p-3 mt-5">
        <h5>If you're logged and simply wish to change your password, click <a href="/Camagru/account">here</a> </h5>
    </div>
</div>

<?php require_once("includes/footer.php");?>
<script src="js/alert.js"></script>
<script src="js/ajaxify.js"></script>
<script src="js/validate.js"></script>
</body>
</html>