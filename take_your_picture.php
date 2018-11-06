<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Take your picture!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css?v=<?php time(); ?>">
</head>

<body>
<?php
require_once("includes/header.php");
if (!isset($_SESSION['logged']) && $_SESSION['logged'] !== 1)
    header('Location: /Camagru/');
?>

<div class="row mt-5" style="max-width: 100%; margin-left: 0px;">
    <div class="wrapper col-7 p-2 offset-1">
        <h1>Don't forget to smile!</h1>
        <video id="video" class="col-12"></video>
        <button id="startbutton" class="offset-4 col-4 mb-2">Prendre une photo</button>
        <canvas id="canvas" class="col-12"></canvas>
        <script src="js/webcam.js"></script>
    </div>
    <div class="wrapper col-2 p-2 offset-1">
        <h1>side with precedently taken pictures</h1>
    </div>
</div>

<?php require_once("includes/footer.php");?>
</body>
</html>