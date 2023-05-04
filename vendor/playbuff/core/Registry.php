<?php

namespace playbuff;

class Registry 
{
    use TSingletone;

    public static $properties = [];

    public static function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public static function getProperty($name)
    {
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        return null;
    }

    public static function deleteProperty($name) 
    {
        if (isset(self::$properties[$name])) {
            unset(self::$properties[$name]);
        }
    }

    public static function debugProperties()
    {
        return self::$properties;
    }
}

?>