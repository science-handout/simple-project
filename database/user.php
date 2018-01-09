<?php

/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */



class user {


public static function insert($dataArray)
{
    if(System::Get('db')->Insert('user',$dataArray))
        return true;

    return false;
}

public static function update($id,$dataArray)
{
    if(System::Get('db')->Update('user',$dataArray,"WHERE `id`=$id"))
        return true;

    return false;
}

public static function delete($id)
{
    if(System::Get('db')->Delete('user',"WHERE `id`=$id"))
        return true;

    return false;
}

public static function select($extra='')
{
    System::Get('db')->Execute("SELECT * FROM `user` $extra");

    if(System::Get('db')->AffectedRows()>0)
        return System::Get('db')->GetRows();

    return [];
}

public function __call($name, $arguments)
{
    return "this function [" .$name. "] not found";
}

}