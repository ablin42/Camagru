<?php

namespace ablin42;

class table
{
    protected static $table;

    private static function getTable()
    {
        if (static::$table === null)
        {
            $class_name = explode('\\', get_called_class());
            static::$table = strtolower(end($class_name));
        }
        return static::$table;
    }

    public static function find($id)
    {
        return app::getDb()->prepare("SELECT * FROM " . static::getTable() . " WHERE id = ?", [$id], get_called_class(), true);
    }


  /*  public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }*/
}