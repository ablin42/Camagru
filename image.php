<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>

<body>
<?php
require_once("includes/header.php");
require_once("utils/functions.php");
use \ablin42\database;
require_once("utils/post_comment.php");

$db = database::getInstance('camagru');
if (!isset($_GET['id']))
    header ('Location: /Camagru/');
$attributes['id'] = $_GET['id'];

$req = $db->prepare("SELECT * FROM `image` LEFT JOIN `user` ON image.id_user = user.id WHERE image.id = :id", $attributes);
if (!$req)
    header ('Location: /Camagru/');

?>

<div class="container mt-5 small-page-wrapper">
    <div class="wrapper col-12 p-2" style="text-align: center;">
        <?php
        foreach($req as $item)
        {
            echo "<h1>$item->name</h1>";
            echo "<h6>Uploaded by $item->username</h6>";
        }?>

        <div class="img-page-wrapper col-6 offset-3">
            <?php foreach($req as $item)
            {
                echo "<img alt=\"{$item->name}\" class=\"img-page col-12\" src=\"{$item->path}\">";
                echo "<div class='overlay'>";
                echo "<div class=\"title-on-img\">";
                echo "<button ";
                if (isset($_SESSION['id']))
                    echo 'onclick="like()"';
                echo "class=\"btn-like\">";
                echo "<i id=\"like-fire\" class=\"fas fa-fire fa-4x like";
                if (isset($_SESSION['id']))
                    if (has_liked($db, $_GET['id'], $_SESSION['id']))
                        echo " liked";
                echo '"></i></button></div></div>';
            }?>
        </div>
        <div class="polaroid col-6 offset-3">
            <i id="like-fire" class="fas fa-fire fa-2x like-count"></i>
            <h5 id="nb_like">
                <?php foreach($req as $item)
                    echo $item->nb_like;
                ?>
            </h5>
        </div>

        <?php if (!isset($_SESSION['id'])) {echo "<h6>You must be logged in to vote!</h6>";} ?>
    </div>


    <div class="wrapper col-12 p-2">
        <h1>comment section</h1>
        <div class="col-6 offset-3">
            <?php
                if (isset($_SESSION['logged']) && isset($_SESSION['username']))
                {
                    echo "<form class=\"my-2 my-lg-0\" action=\"image?id={$_GET['id']}\" method=\"post\">";
                    echo $form->textarea('comment', 'comment', "form-control", "3", "50", "Your comment here... Be nice...", 255);
                    echo $form->hidden('id_img', $attributes['id'], 'id_img');
                    echo $form->submit('submit', 'submit', 'btn btn-outline-warning btn-sign-in', 'Send');
                    echo "</form>";
                }
                else
                    echo "<h6>You must be logged in to comment under pictures.</h6>";
            ?>
        </div>
        <div class="col-6 offset-3">
            <?php require_once("utils/fetch_comments.php");?>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php");?>
<script src="js/alert.js"></script>
<script>
    function like()
    {
        var xhttp = new XMLHttpRequest();
        var nb_like = document.getElementById("nb_like");
        var fire = document.getElementById("like-fire");
        var vote = 0;
        var id_img = parseInt("<?php echo $_GET['id'];?>");
        var id_user = parseInt("<?php echo $_SESSION['id'];?>");
        
        if(fire.classList.contains("liked"))
        {
            vote = -1;
            fire.classList.remove("liked");
        }
        else {
            vote = 1;
            fire.classList.add("liked");
        }

        xhttp.open("POST", "utils/like.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`id=${id_img}&u=${id_user}`);

        nb_like.innerText = parseInt(nb_like.innerText) + vote;
    }
</script>
</body>
</html>