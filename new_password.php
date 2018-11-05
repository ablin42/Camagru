
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - New password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php require_once("includes/header.php"); ?>
<div class="container mt-5">
    <div class="wrapper col-12 p-2">
        <h5>Reset your password</h5>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form class="my-2 my-lg-0" action="utils/password_update.php?id=<?php echo "{$_GET['id']}&token={$_GET['token']}";?>" method="post">
                <?php
                $form->setLabel('Password', 'lab');
                echo $form->password('password', 'password', "form-control");
                $form->setLabel('Confirm your password', 'lab');
                echo $form->password('password2', 'password2', "form-control", "Confirm Password");
                echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in mb-1', 'Set new password');
                ?>
            </form>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php");?>
</body>
</html>