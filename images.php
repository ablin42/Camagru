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

<div class="container mt-5">
    <div class="wrapper col-12 p-2">
        <?php
        foreach($req as $item)
        {
            echo "<h1>$item->name</h1>";
            echo "<h4>Uploaded by $item->username</h4>";
        }?>

        <div class="col-6 offset-3">
            <?php foreach($req as $item)
            {
                echo "<img alt=\"{$item->name}\" class=\"gallery-img col-12\" src=\"{$item->path}\">";
            }?>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="wrapper col-12 p-2">
        <h1>Comment section</h1>
        <div class="col-6 offset-3">
            <?php
                if (isset($_SESSION['logged']) && isset($_SESSION['username']))
                {
                    echo "<form class=\"my-2 my-lg-0\" action=\"images.php?id={$_GET['id']}\" method=\"post\">";
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
</body>
</html>