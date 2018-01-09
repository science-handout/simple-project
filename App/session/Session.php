<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */

class Session
{
    public static function Start()
    {
        @session_start();
    }
    public static function Set($key,$value)
    {
        $_SESSION[$key] = $value;
    }
    public static function Get($key)
    {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
    }

    public static function Stop()
    {
        session_destroy();
    }
}