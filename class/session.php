<?php

namespace ablin42;

class session
{
    protected static $_instance;
    protected $info = array();

    protected function __construct()
    {
        $this->info = $_SESSION;
    }

    public function setInfo($name, $value)
    {
        if (array_key_exists($name, $this->info))
        {
            $this->info[$name] = $value;
            return true;
        }
        return false;
    }

    public function addInfo($name, $value)
    {
        if (array_key_exists($name, $this->info))
            return false;
        $this->info[$name] = $value;
        return true;
    }

    public function getInfo($name = null)
    {
        if ($name === null)
            return $this->info;
        if (array_key_exists($name, $this->info))
            return $this->info[$name];
        return null;
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance))
            self::$_instance = new session();
        return self::$_instance;
    }
}