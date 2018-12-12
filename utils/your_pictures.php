<?php
use \ablin42\database;

$db = database::getInstance('camagru');

$req = $db->prepare("SELECT * FROM `image` WHERE `id_user` = :id_user ORDER BY `date` DESC", array("id_user" => $_SESSION['id']));
foreach($req as $item)
{
  echo "<div class='your-img' style='text-align: center;'>";
  echo "<h6>$item->name</h6>";
  echo "<img class='img-mini' width='100%' src=\"$item->path\" alt=\"$item->name\" />";
  echo "<a href=\"glorify?id={$item->id}&r=d\"><i class=\"fas fa-trash rmv-img\"></i></a>";
  echo "</div>";
}