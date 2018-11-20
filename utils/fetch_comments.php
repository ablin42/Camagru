<?php
use \ablin42\database;

$db = database::getInstance('camagru');

$req = $db->prepare("SELECT * FROM `comment` LEFT JOIN `user` ON comment.id_user = user.id WHERE comment.id_img = :id ORDER BY `date` DESC LIMIT 10", $attributes);
foreach($req as $item)
{
    echo "<div class=\"comment\">";
    echo "<b class='com-username'>{$item->username}</b>";
    echo "<p class='com-content'>{$item->content}</p>";
    echo "</div>";
}