<?php

/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */

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

