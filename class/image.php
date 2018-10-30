<?php

namespace ablin42;

class image extends table
{
    public static function getLast()
    {
        return app::getDb()->query("SELECT * FROM user", __CLASS__);
    }
}