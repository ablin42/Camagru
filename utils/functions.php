<?php

function gen_token($length)
{
    $tab = "0123456789azertyuiopqsdfghjklmwxcvbn";
    return substr(str_shuffle(str_repeat($tab, $length)), 0, $length);
}

function alert_bootstrap($type, $message, $style = "")
{
    return "<div class=\"alert alert-{$type}\" style=\"$style\" role=\"alert\">{$message}</div>";
}