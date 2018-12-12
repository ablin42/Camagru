<?php
include("database.php");

//CREATING DATABASE
try {
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//no database name here
    $db->query("CREATE DATABASE IF NOT EXISTS `{$DB_NAME}`");
    $db = new PDO($DB_DSN_FULL, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//now we specify db name
    echo "Successfully created database '{$DB_NAME}'" . PHP_EOL;
    } catch (PDOException $e) {
    echo "ERROR CREATING DB '{$DB_NAME}': \n".$e->getMessage()."\nAborting process\n" . PHP_EOL;
    exit(-1);
    }


//CREATING USER TABLE
try {
    $db->query("CREATE TABLE `user` (
                                              `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                              `username` varchar(30) NOT NULL UNIQUE,
                                              `password` varchar(255) NOT NULL,
                                              `email` varchar(255) NOT NULL UNIQUE,
                                              `password_token` varchar(128) DEFAULT NULL,
                                              `mail_token` varchar(128) DEFAULT NULL,
                                              `confirmed_token` datetime DEFAULT NULL,
                                              `mail_notify` tinyint(1) NOT NULL DEFAULT '1'
                                              )");
    echo "Successfully created 'USER' table" . PHP_EOL;
    } catch (PDOException $e) {
    echo "ERROR CREATING 'USER' TABLE: \n".$e->getMessage()."\nAborting process\n" . PHP_EOL;
    exit(-1);
    }

//CREATING IMAGE TABLE
try {
    $db->query("CREATE TABLE `image` (
                                                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                                `id_user` int(11) NOT NULL DEFAULT '0' COMMENT 'ID de l''user qui a upload l''image',
                                                `path` varchar(255) NOT NULL DEFAULT '/Camagru/images/',
                                                `name` varchar(64) DEFAULT NULL,
                                                `date` datetime NOT NULL,
                                                `nb_like` int(11) NOT NULL DEFAULT '0'
                                                )");
    echo "Successfully created 'IMAGE' table" . PHP_EOL;
} catch (PDOException $e) {
    echo "ERROR CREATING 'IMAGE' TABLE: \n".$e->getMessage()."\nAborting process\n" . PHP_EOL;
    exit(-1);
}


//CREATING COMMENT TABLE
try {
    $db->query("CREATE TABLE `comment` (
                                                  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                                  `id_img` int(11) NOT NULL COMMENT 'id of the img being commented',
                                                  `id_user` int(11) NOT NULL COMMENT 'id of the user commenting',
                                                  `content` varchar(255) NOT NULL,
                                                  `date` datetime NOT NULL
                                                 )");
    echo "Successfully created 'COMMENT' table" . PHP_EOL;
} catch (PDOException $e) {
    echo "ERROR CREATING 'COMMENT TABLE': \n".$e->getMessage()."\nAborting process\n" . PHP_EOL;
    exit(-1);
}

//CREATING VOTE TABLE
try {
    $db->query("CREATE TABLE `vote` (
                                              `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                              `id_img` int(11) NOT NULL COMMENT 'id of the img liked',
                                              `id_user` int(11) NOT NULL COMMENT 'id of the user liking'
                                              )");
    echo "Successfully created 'VOTE' table" . PHP_EOL;
} catch (PDOException $e) {
    echo "ERROR CREATING 'VOTE' TABLE: \n".$e->getMessage()."\nAborting process\n" . PHP_EOL;
    exit(-1);
}
header('Location: /Camagru/');

