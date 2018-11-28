<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php
require_once("includes/header.php");
if (!isset($_SESSION['logged']) && $_SESSION['logged'] !== 1)
    header('Location: /Camagru/');
require_once("utils/modify_account.php");
?>

<div class="container mt-5">
    <div class="wrapper col-12 p-2">
        <h5>Account settings</h5>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form class="my-2 my-lg-0" action="account.php" method="post">
                <?php
                $form->changeSurr('div class="form-group d-inline-block col-8 pl-0"', 'div');
                $form->setLabel('Username', 'lab');
                echo $form->input('username', 'username', "form-control forms", "{$_SESSION['username']}");
                $form->changeSurr('div class="form-group d-inline-block col-4"', 'div');
                echo $form->submit('submit_account', 'submit_account', 'btn btn-outline-warning btn-sign-in mb-1', 'Save');
                ?>
            </form>
        </div>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form class="my-2 my-lg-0" action="account.php" method="post">
                <?php
                $form->changeSurr('div class="form-group d-inline-block col-8 pl-0"', 'div');
                $form->setLabel('E-mail', 'lab');
                echo $form->email('email', 'email', "form-control forms", "E-mail");
                $form->changeSurr('div class="form-group d-inline-block col-4"', 'div');
                echo $form->submit('submit_email', 'submit_email', 'btn btn-outline-warning btn-sign-in mb-1', 'Save');
                ?>
            </form>
        </div>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form onsubmit="return validate();" class="my-2 my-lg-0" action="account.php" method="post">
                <?php
                $form->changeSurr('div class="form-group"', 'div');
                $form->setLabel('Current password', 'lab');
                echo $form->password('currpw', 'currpw', "form-control forms", "Current password");
                $form->setLabel('New password', 'lab');
                echo $form->password('newpw', 'newpw', "form-control forms", "New password");
                $form->setLabel('Confirm your new password', 'lab');
                echo $form->password('newpw2', 'newpw2', "form-control forms", "Confirm your new password");
                $form->changeSurr('div class="form-group"', 'div');
                echo $form->submit('submit_password', 'submit_password', 'btn btn-outline-warning btn-sign-in mb-1', 'Save');
                ?>
            </form>
        </div>
        <div class="register-form-wrapper container col-6 p-3 mt-3 mb-3">
            <form class="my-2 my-lg-0" action="account.php" method="post" style="text-align: center;">
                <input type="checkbox" id="notify" name="notify" value="true" <?php if (notif_state($db, $_SESSION['id']) === true){echo "checked";}?>><p>Notify me by mail when someone comments one of my photo</p>
                <?= $form->submit('submit_notify', 'submit_notify', 'btn btn-outline-warning btn-sign-in mb-1', 'Save');?>
            </form>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php");?>
<script>
    function validate() {
        var password = document.getElementById('newpw').value;
        var password2 = document.getElementById('newpw2').value;
        if (password.length < 8 || password2.length < 8) {
            alert("Password should be at least 8 characters long!");
            return false;
        }

        return true;
    }
</script>
<script src="js/alert.js"></script>
</body>
</html>