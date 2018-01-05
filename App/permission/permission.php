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
        if(!$this->session->Get($name)){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }


    public function Display($error = '',$header = '',$content = '',$footer = ''){
        if ($this->IsLogin()){
            $message = 'you are not login';
            require_once "../layout/Back/Errors/".$error.".html";
            exit();
        }else{
            require_once "../layout/Back/".$header.".html";
            ($content) ? require_once "../layout/Back/".$content.".html": '' ;
            require_once "../layout/Back/".$footer.".html";
        }
    }



}