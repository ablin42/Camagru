<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Take your picture!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css?">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
<?php
require_once("includes/header.php");
require_once("utils/upload.php");
require_once("utils/delete_picture.php");
require_once("utils/upload_webcam.php");
if (!isset($_SESSION['logged']) && $_SESSION['logged'] !== 1)
    header('Location: /Camagru?e=take');
?>

<div class="row mt-5" style="max-width: 100%; margin-left: 0px;">
    <div class="wrapper col-7 p-2 offset-1">
        <h1>Don't forget to smile!</h1>
        <h6>... and to choose a filter!</h6>

        <div class="row pl-5 pr-5">
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="emeraude" onclick="applyFilter('emeraude.png')">
                <img alt="dofus emeraude" src="filters/emeraude.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="turquoise" onclick="applyFilter('turquoise.png')">
                <img alt="dofus turquoise" src="filters/turquoise.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="pourpre" onclick="applyFilter('pourpre.png')">
                <img alt="dofus pourpre" src="filters/pourpre.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="ocre" onclick="applyFilter('ocre.png')">
                <img alt="dofus ocre" src="filters/ocre.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="ivoire" onclick="applyFilter('ivoire.png')">
                <img alt="dofus ivoire" src="filters/ivoire.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="ebene" onclick="applyFilter('ebene.png')">
                <img alt="dofus ebene" src="filters/ebene.png" class="filter"/>
            </div>
        </div>

        <div class="row pl-5 pr-5">
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="gein" onclick="applyFilter('gein.png')">
                <img alt="chapeau de gein" src="filters/gein.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="ouga" onclick="applyFilter('ouga.png')">
                <img alt="coiffe de l'ougah" src="filters/ouga.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="ben" onclick="applyFilter('ben.png')">
                <img alt="coiffe de ben le ripate" src="filters/ben.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="solomonk" onclick="applyFilter('solomonk.png')">
                <img alt="solomonk" src="filters/solomonk.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="rdv" onclick="applyFilter('rdv.png')">
                <img alt="coiffe reine des voleurs" src="filters/rdv.png" class="filter"/>
            </div>
            <div class="item">
                <input class="filter-checkbox" type="checkbox" id="comte" onclick="applyFilter('comte.png')">
                <img alt="coiffe du comte harebourg" src="filters/comte.png" class="filter"/>
            </div>
        </div>

        <video muted="muted" id="video" class="col-12"></video>
        <button onclick="cooldown(this);" id="startbutton" class="offset-4 col-4 mb-2" disabled>MAKE ME GLORIOUS!</button>
        <canvas id="canvas" class="col-12" style="display: none;"></canvas>
        <form action="glorify" method="post" enctype="multipart/form-data" style="text-align: center;">
        <?php
            $form->setLabel('IMAGE\'S TITLE', 'lab');
            echo $form->input("img_name_cam", "img_name_cam", "form-control", "Your title", 64);
            echo $form->hidden("id_user_cam", $_SESSION['id'], "id_user_cam");
            echo $form->hidden("img_url", "", "img_url");
            echo $form->hidden("filter", "", "filter");
            echo $form->hidden("tmp_img", "", "tmp_img");
            echo $form->submit('submit_cam', 'submit_cam', 'btn btn-outline-warning btn-sign-in', 'Upload');
        ?>
        </form>
        <div>
            <h1>Upload your photo if you don't have a webcam</h1>
            <div class="register-form-wrapper col-8 offset-2 p-2">
            <form action="glorify" method="post" enctype="multipart/form-data">
                <?php
                    $form->setLabel('IMAGE\'S TITLE', 'lab');
                    echo $form->input("img_name", "img_name", "form-control", "Your title", 64);
                    echo $form->hidden("id_user", $_SESSION['id'], "id_user");
                    echo $form->hidden("MAX_FILE_SIZE", "2000000");
                    echo $form->file("picture", "picture");
                    echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in', 'Upload');
                ?>
            </form>
            </div>
        </div>
    </div>
    <div class="wrapper col-2 p-2 offset-1">
        <h1>Your pictures</h1>
        <?php require_once("utils/your_pictures.php"); ?>
    </div>
</div>

<?php require_once("includes/footer.php");?>
<script src="js/webcam.js"></script>
<script src="js/cooldown.js"></script>
<script src="js/upload.js"></script>
<script src="js/alert.js"></script>
<script src="js/filter.js"></script>
</body>
</html>