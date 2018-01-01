<?php

/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
System::Set('db',new mysqlDB());

class System {

    private static $objects;


    public static function Set($key,$value)
    {
        self::$objects[$key] = $value;
    }

    public static function Get($key)
    {
        if(isset(self::$objects[$key]))
            return self::$objects[$key];

        return null;
    }

}

