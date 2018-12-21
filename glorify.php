<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru - Take your picture!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css?">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>

<body onresize="resizePreview()">
<?php
require_once("includes/header.php");
if (!isset($_SESSION['logged']) && $_SESSION['logged'] !== 1)
    header('Location: /Camagru/?e=take');
?>

<div class="row mt-5" style="max-width: 100%; margin-left: 0;">
    <div class="main-glorify wrapper col-7 p-2 offset-2">
        <h1>don't forget to smile!</h1>
        <h6>... and to choose a filter!</h6>
        <div class="container container-filters col-10 offset-1 p-3">
            <div class="row">
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('emeraude.png')" alt="dofus emeraude" src="filters/emeraude.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('turquoise.png')" alt="dofus turquoise" src="filters/turquoise.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('pourpre.png')" alt="dofus pourpre" src="filters/pourpre.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('ocre.png')" alt="dofus ocre" src="filters/ocre.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('ivoire.png')" alt="dofus ivoire" src="filters/ivoire.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('ebene.png')" alt="dofus ebene" src="filters/ebene.png" class="filter"/>
                </div>
            </div>

            <div class="row">
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('gein.png')" alt="chapeau de gein" src="filters/gein.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('ouga.png')" alt="coiffe de l'ougah" src="filters/ouga.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('ben.png')" alt="coiffe de ben le ripate" src="filters/ben.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('solomonk.png')" alt="solomonk" src="filters/solomonk.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('rdv.png')" alt="coiffe reine des voleurs" src="filters/rdv.png" class="filter"/>
                </div>
                <div class="item col">
                    <img onmouseout="hoverFilter(this, 'out');" onmouseover="hoverFilter(this, 'in');" onclick="applyFilter('comte.png')" alt="coiffe du comte harebourg" src="filters/comte.png" class="filter" style="width:75px"/>
                </div>
            </div>
        </div>
        <div id="video-div">
            <div ondrop="drop(event)" ondragover="allowDrop(event)" id="preview" class="preview"></div>
            <video muted="muted" id="video" class="col-10 offset-1"></video>
        </div>
        <button onclick="cooldown(this);" id="startbutton" class="offset-4 col-4 mb-2 mt-2" disabled>MAKE ME GLORIOUS!</button>
        <canvas id="canvas" class="col-12" style="display: none;"></canvas>
        <div class="register-form-wrapper col-10 offset-1 p-2 mt-3 mb-4">
            <h2>pick a title and upload your photo!</h2>
            <h5>...once you're done taking it</h5>
            <form onsubmit="return submitForm(this, 'post_picture');" name="post_picture" action="" method="post" enctype="multipart/form-data" style="text-align: center;">
                <?php
                    echo $form->input("img_name", "img_name", "form-control", "Your title", 64);
                    echo $form->hidden("img_url", "", "img_url");
                    echo $form->submit('submit_post_picture', 'submit_post_picture', 'btn btn-outline-warning btn-sign-in', 'Upload');
                ?>
            </form>
        </div>
        <hr>
        <div class="register-form-wrapper col-10 offset-1 p-2 mb-3 mt-4">
            <h2>upload your photo if you don't have a webcam</h2>
            <form name="upload" action="" method="post" enctype="multipart/form-data" class="text-center">
                <?php
                    $form->setLabel("pick a file", "lab file-lab");
                    echo $form->file("picture", "picture", "inputfile");
                    echo $form->submit('submit_upload', 'submit_upload', 'btn btn-outline-warning btn-sign-in', 'Upload');
                ?>
            </form>
        </div>
    </div>
    <div class="wrapper your-pictures col-2 p-2">
        <h1>your pictures</h1>
        <?php require_once("utils/your_pictures.php"); ?>
    </div>
</div>

<?php require_once("includes/footer.php"); require_once("utils/upload.php");?>
<script src="js/filter.js"></script>
<script src="js/dragandrop.js"></script>
<script src="js/webcam.js?v=<?= time(); ?>"></script>
<script src="js/cooldown.js"></script>
<script src="js/upload.js"></script>
<script src="js/alert.js"></script>
<script src="js/ajaxify.js"></script>
<script>
    setTimeout(function (){
       resizePreview();
    }, 2750);
</script>
</body>
</html>