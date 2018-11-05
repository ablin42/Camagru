<?php
session_start();
use \ablin42\bootstrapForm;
use \ablin42\autoloader;

require ("class/autoloader.php");
autoloader::register();
$form = new bootstrapForm();
$form->changeSurr('div class="form-group"', 'div');
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="/Camagru">Home</a>

    <!-- PROBABLY SHRINK BUTTON
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>-->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav navbar-right ml-auto">
            <?php
                if (isset($_SESSION['logged']) && isset($_SESSION['username']))
                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"account.php\">{$_SESSION['username']}</a></li>";
                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"take_your_picture.php\">Take pictures !</a></li>";
            ?>
            <form class="form-inline my-2 my-lg-0" action="utils/login.php" method="post">
                <?php
                    if (!isset($_SESSION['logged']))
                    {
                        echo $form->label('Username', 'username_l', 'lab mr-2 ml-2');
                        echo $form->input('username_l', 'username_l', "form-control");
                        echo $form->label('Password', 'password_l', 'lab mr-2 ml-2');
                        echo $form->password('password_l', 'password_l', "form-control");
                        echo $form->submit('submit_l', 'submit_l', 'btn btn-outline-warning my-2 my-sm-0 ml-2', 'Log in');
                    }
                ?>
            </form>
            <?php
                if (!isset($_SESSION['logged']))
                {
                    echo '<li class="nav-item"><a class="nav-link" href="password.php">Forgot your password?</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="register.php">Sign up</a></li>';
                }
                else
                    echo '<li class="nav-item"><a class="nav-link" href="utils/logout.php">Logout</a></li>';
                ?>
        </ul>
    </div>
</div>
</nav>