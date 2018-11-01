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
if (!isset($_SESSION['logged']) && $_SESSION['logged'] !== 1)
    header('Location: /Camagru/');
?>

<div class="row mt-5" style="max-width: 100%; margin-left: 0px;">
    <div class="wrapper col-7 p-2 offset-1">
        <h1>main</h1>
        <video id="video"></video>
        <button id="startbutton">Prendre une photo</button>
        <canvas id="canvas"></canvas>
        <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
        <script src="js/webcam.js"></script>
    </div>
    <div class="wrapper col-2 p-2 offset-1">
        <h1>side with precedently taken pictures</h1>
    </div>
</div>

<?php require_once("includes/footer.php");?>
</body>
</html>