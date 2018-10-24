<?php

namespace ablin42;

class bootstrapForm extends form
{
    public function label($name, $for, $class = "")
    {
        return "<label for=\"{$for}\" class=\"{$class}\">{$name}</label>";
    }

    public function input($name, $id = "", $class = "")
    {
        return $this->surround("<input type=\"text\" name=\"{$name}\" id=\"{$id}\" class=\"{$class}\">");
    }

    public function email($name, $id = "", $class = "")
    {
        return $this->surround("<input type=\"email\" name=\"{$name}\" id=\"{$id}\" class=\"{$class}\">");
    }

    public function password($name, $id = "", $class = "")
    {
        return $this->surround("<input type=\"password\" name=\"{$name}\" id=\"{$id}\" class=\"{$class}\">");
    }

}
