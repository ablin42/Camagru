<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camagru</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
</head>

<body>
<?php
require_once("includes/header.php");

if (isset($_GET['e']))
    redirection_handler($_GET['e']);

use ablin42\database;
$db = database::getInstance('camagru');
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $req = $db->prepare("SELECT `infinite_scroll` FROM `user` WHERE `id` = :id", array("id" => $id));
    if ($req) {
        foreach ($req as $item)
            if ($item->infinite_scroll == 1)
                echo '<script src="js/infiniteScroll.js"></script>';
    }
     else
         echo '<script src="js/infiniteScroll.js"></script>';
}
else
    echo '<script src="js/infiniteScroll.js"></script>';
$req = $db->query("SELECT COUNT(id) AS nb FROM `image`");
foreach ($req as $item)
{
    $nb = $item->nb;
    break;
}
$perPage = 6;
$nbPage = ceil($nb / $perPage);
if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
    $cPage = $_GET['p'];
else
    $cPage = 1;
$startLimit = (($cPage - 1) * $perPage);
?>

<div class="container mt-5">
    <div class="wrapper col-12 p-2">
        <h1>all the awesome pictures!</h1>
        <div class="gallery-wrapper" id="gallery-wrapper">
            <?php require_once("utils/fetch_gallery.php"); ?>
            <div id="loader"><img src="style/loader.gif" alt="loader" width="50px" height="50" /></div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php");?>
<script src="js/alert.js"></script>
</body>
</html>