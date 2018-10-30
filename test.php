<?php

use \ablin42\session;
use \ablin42\autoloader;
require ("class/autoloader.php");
autoloader::register();

$session = session::getInstance();
$session->login = "harbi";
$session->setInfo("harbinger");

$session2 = session::getInstance();
$se = $session2->getSession();
echo $se['username'];
var_dump($session2->getInfo());
/*use \ablin42\app;
use \ablin42\autoloader;
require ("class/autoloader.php");
autoloader::register();

$app = app::getInstance();
$app->autism = "fuckyou";
$app->cancer = true;

$app2 = app::getInstance();
var_dump($app2->autism);
var_dump($app2->cancer);*/

/*
$data = app::getInstance()->query("SELECT * FROM user");
foreach ($data as $elem)
{
    echo $elem->username . PHP_EOL;
    echo $elem->email . PHP_EOL;
}
*/