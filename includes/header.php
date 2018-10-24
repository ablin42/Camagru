<?php

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
            <li class="nav-item"><a class="nav-link" href="account.php">Harbinger</a></li>
            <form class="form-inline my-2 my-lg-0" action="login.php" method="post">
                <?php
                    echo $form->label('Username', 'username', 'lab mr-2 ml-2');
                    echo $form->input('username', 'username', "form-control");
                    echo $form->label('Password', 'password', 'lab mr-2 ml-2');
                    echo $form->password('password', 'password', "form-control");
                    echo $form->submit('submit', 'submit', 'btn btn-outline-warning my-2 my-sm-0 ml-2', 'Log in');
                ?>
            </form>
            <li class="nav-item"><a class="nav-link" href="register.php">Sign up</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
</nav>