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

<div class="container mt-5">
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
      <!--  <span class="fas fa-fire fa-2x like"></span>-->
        <div class="div-like" data-href="" data-img="" data-user="">
        <form action="utils/like.php?id=<?php echo $_GET['id'];?>&u=<?php echo $_SESSION['id'];?>" method="post">
            <button type="submit" class="btn-like"><i class="fas fa-fire fa-2x like<?php if (has_liked($db, $_GET['id'], $_SESSION['id'])) {echo " liked";} ?>"></i></button>
        </form>
        </div>
        <h6>
            <?php foreach($req as $item)
                echo $item->nb_like;
            ?>
        </h6>
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