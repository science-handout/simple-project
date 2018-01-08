<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */
class csrf
{
    private static $instance;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {
        if(null === self::$instance)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setupToken()
    {
        if(!isset($_SESSION['CSRFToken'])) {
            self::generateCSRFToken();
        }
    }

    private static function generateCSRFToken()
    {
        $_SESSION['CSRFToken'] = md5(rand(1, 1000000) . session_id() . time());
    }
}
