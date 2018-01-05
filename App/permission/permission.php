<?php

class permission {

    public $session;

    public function __construct($session_name,$error,$header,$content,$footer)
    {
        $this->session = new Session();
        $this->IsLogin($session_name);
        $this->Display($error,$header,$content,$footer);

    }


    public function IsLogin($name){
        if($this->session->Get($name)){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }


    public function Display($error = '',$header = '',$content = '',$footer = '')
    {

        if ($content == 'login') {
            if (!$this->IsLogin()) {
                ($content) ? require_once "../layout/Back/" . $content . ".html" : '';
            }else{
                $message = 'you are login';
                ($error) ? require_once "../layout/Back/Errors/" . $error . ".html" : '';
                exit();
            }
        }elseif ($content == 'logout'){

            if (!$this->IsLogin()) {
                ($content) ? require_once "../layout/Back/" . $content . ".html" : '';
            }else{
                $this->session->Stop();
            }

        } else {
            if (!$this->IsLogin()) {
                $message = 'you are not login';
                ($error) ? require_once "../layout/Back/Errors/" . $error . ".html" : '';
                exit();

            } else {
                ($header) ? require_once "../layout/Back/" . $header . ".html" : '';
                ($content) ? require_once "../layout/Back/" . $content . ".html" : '';
                ($footer) ? require_once "../layout/Back/" . $footer . ".html" : '';
            }
        }
    }
}