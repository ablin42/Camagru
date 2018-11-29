<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
<?php
require_once("includes/header.php");
require_once("utils/functions.php");
use \ablin42\database;
require_once("utils/comment.php");

$db = database::getInstance('camagru');
if (!isset($_GET['id']))
    header ('Location: /Camagru/');
$attributes['id'] = $_GET['id'];

$req = $db->prepare("SELECT * FROM `image` LEFT JOIN `user` ON image.id_user = user.id WHERE image.id = :id", $attributes);
if (!$req)
    header ('Location: /Camagru/');

?>

<div class="container mt-5 small-page-wrapper">
    <div class="wrapper col-12 p-2">
        <?php
        foreach($req as $item)
        {
            echo "<h1>$item->name</h1>";
            echo "<h4>Uploaded by $item->username</h4>";
        }?>

        <div class="col-6 offset-3 img-holder">
            <?php foreach($req as $item)
            {
                echo "<img alt=\"{$item->name}\" class=\"gallery-img col-12\" src=\"{$item->path}\">";
            }?>
        </div>
        <div>
            <button <?php if (isset($_SESSION['id'])) {echo "onclick=\"like({$_GET['id']}, {$_SESSION['id']})\"";}?> class="btn-like">
                <i id="like-fire" class="fas fa-fire fa-2x like<?php if (isset($_SESSION['id'])) {if (has_liked($db, $_GET['id'], $_SESSION['id'])) {echo " liked";}} ?>"></i>
            </button>
        </div>
        <h6 id="nb_like">
            <?php foreach($req as $item)
                echo $item->nb_like;
            ?>
        </h6>
        <?php if (!isset($_SESSION['id'])) {echo "<h6>You must be logged in to vote!</h6>";} ?>
    </div>


    <div class="wrapper col-12 p-2">
        <h1>Comment section</h1>
        <div class="col-6 offset-3">
            <?php
                if (isset($_SESSION['logged']) && isset($_SESSION['username']))
                {
                    echo "<form class=\"my-2 my-lg-0\" action=\"image.php?id={$_GET['id']}\" method=\"post\">";
                    echo $form->textarea('comment', 'comment', "form-control", "3", "50", "Your comment here... Be nice...");
                    echo $form->hidden('id_img', $attributes['id'], 'id_img');
                    echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in', 'Send');
                    echo "</form>";
                }
                else
                    echo "<h5>You must be logged in to comment under pictures.</h5>";
            ?>
        </div>
        <div class="col-6 offset-3">
            <?php require_once("utils/fetch_comments.php");?>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php");?>
<script src="js/like.js"></script>
<script src="js/alert.js"></script>
</body>
</html>