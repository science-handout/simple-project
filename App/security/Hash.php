<?php

class Hash{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    function hashing($password)
    {
        return sha1('Accxrthjademay&$@&'.md5(')(fddfstreet25468'.$password.'edngwwdalissadh*#$%6!'));
    }

}