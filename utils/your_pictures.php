<?php
use \ablin42\database;

$db = database::getInstance('camagru');

$req = $db->prepare("SELECT * FROM `image` WHERE `id_user` = :id_user", array("id_user" => $_SESSION['id']));
foreach($req as $item)
{
  echo "<div class='your_img'>";
  echo "<h6>$item->name</h6>";
  echo "<img width='100%' src=\"$item->path\" alt=\"$item->name\" />";
  echo "</div>";
}