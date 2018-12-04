<?php

namespace ablin42;

class bootstrapForm extends form
{
    private $label_name;
    private $label_class;
    private $info_text;
    private $info_class;
    private $info_use;

    public function label($name, $for, $class = "")
    {
        return "<label for=\"{$for}\" class=\"{$class}\">{$name}</label>";
    }

    public function setLabel($label_name, $label_class = "")
    {
        $this->label_name = $label_name;
        $this->label_class = $label_class;
    }

    public function info($text, $class = "", $use = "no")
    {
        if ($use === "no")
            return '';
        else
            return "<span class=\"$class\">$text</span>";
    }

    public function setInfo($info_text, $info_class = "", $info_use = "")
    {
        $this->info_text = $info_text;
        $this->info_class = $info_class;
        $this->info_use = $info_use;
    }

    public function input($name, $id = "", $class = "", $placeholder = "")
    {
        return $this->surround($this->label(ucfirst($this->label_name), $name, $this->label_class)
                . "<input type=\"text\" name=\"{$name}\" placeholder=\"{$placeholder}\" id=\"{$id}\" class=\"{$class}\" required>"
                . $this->info($this->info_text, $this->info_class, $this->info_use));
    }

    public function email($name, $id = "", $class = "", $placeholder = "Email")
    {
        return $this->surround($this->label(ucfirst($this->label_name), $name, $this->label_class)
                . "<input type=\"email\" name=\"{$name}\" placeholder=\"{$placeholder}\" id=\"{$id}\" class=\"{$class}\" required>"
                . $this->info($this->info_text, $this->info_class, $this->info_use));
    }

    public function password($name, $id = "", $class = "", $placeholder = "Password")
    {
        return $this->surround($this->label(ucfirst($this->label_name), $name, $this->label_class)
                . "<input type=\"password\" name=\"{$name}\" placeholder=\"{$placeholder}\" id=\"{$id}\" class=\"{$class}\" required>"
                . $this->info($this->info_text, $this->info_class, $this->info_use));
    }

}
