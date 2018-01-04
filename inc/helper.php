<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 1/4/2018
 * Time: 5:05 PM
 */

$help = new helper();

class helper
{

    public function dd($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }


}