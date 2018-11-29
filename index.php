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
<?php require_once("includes/header.php");
use ablin42\database;
$db = database::getInstance('camagru');
$req = $db->query("SELECT COUNT(id) AS nb FROM `image`");
foreach ($req as $item)
{
    $nb = $item->nb;
    break;
}
$perPage = 4;
$nbPage = ceil($nb / $perPage);
if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
    $cPage = $_GET['p'];
else
    $cPage = 1;
$startLimit = (($cPage - 1) * $perPage);
?>

<div class="container mt-5">
    <div class="wrapper col-12 p-2">
        <h1>gallery</h1>
        <?php require_once("utils/fetch_gallery.php"); ?>
    </div>
</div>

<?php require_once("includes/footer.php");?>
<script src="js/alert.js"></script>
</body>
</html>