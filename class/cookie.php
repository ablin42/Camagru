<?php

namespace ablin42;

class cookie
{
    protected static $_instance;
    protected $info = array();

    protected function __construct()
    {
        $this->info = $_COOKIE;
    }

    public function setCookie($name, $value = null, $expire = null, $path = null, $domain = null, $secure = null, $httponly = null)
    {
        $set = setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
        return $set;
    }

    public function getCookie($name)
    {
        if (isset($_COOKIE) && is_array($_COOKIE) && array_key_exists($name, $_COOKIE))
            return $_COOKIE[$name];
        return false;
    }

    public function unsetCookie($name)
    {
        if ($this->getCookie($name) != false)
        {
            setcookie($name, "", time() - 3600);
            return true;
        }
        return false;
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance))
            self::$_instance = new cookie();
        return self::$_instance;
    }
}