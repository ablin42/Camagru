<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['logged']);
session_destroy();
header('Location: ../index.php');