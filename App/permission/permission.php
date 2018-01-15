<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */
class permission {


    public static function start($session_name,$error,$header,$content,$footer)
    {

        $resLogin = permission::IsLogin($session_name);
        permission::Display($error,$header,$content,$footer,$resLogin);

    }


    public static function IsLogin($name){
        if($_SESSION[$name]){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }



    public static function Display($error = '',$header = '',$content = '',$footer = '',$resLogin)
    {

        if ($content == 'login') {
            if (!$resLogin) {
                ($content) ? require_once "../layout/Back/" . $content . ".html" : '';
            }else{
                $message = 'you are login';
                ($error) ? require_once "../layout/Back/Errors/" . $error . ".html" : '';
                exit();
            }
        }elseif ($content == 'logout'){

            if (!$resLogin) {
                ($content) ? require_once "../layout/Back/" . $content . ".html" : '';
            }else{
                session::Stop();
            }

        } elseif($content != 'login' || $content != 'logout') {
            if (!$resLogin) {
                $message = 'you are not login';
                ($error) ? require_once "../layout/Back/Errors/" . $error . ".html" : '';
                exit();

            } else {
                ($header) ? require_once "../layout/Back/" . $header . ".html" : '';
                ($content) ? require_once "../layout/Back/" . $content . ".php" : '';
                ($footer) ? require_once "../layout/Back/" . $footer . ".html" : '';
            }
        }
    }


}