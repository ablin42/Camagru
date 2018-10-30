<?php

namespace ablin42;

class alertHtml
{
    public function alert($type, $message, $style = "")
    {
        return "<div class=\"alert alert-{$type}\" style=\"$style\" role=\"alert\">{$message}</div>";
    }
}