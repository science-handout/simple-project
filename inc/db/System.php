<?php

/**
 * DB SYSTEM
 * singleton pattern to db
 * @author mohamed amr
 */

// use PDO
System::Set('db',new PdoDB());
// use mysqli
//System::Set('db',new mysqli());

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

