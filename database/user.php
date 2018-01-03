<?php

/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */

$user = new user();


class user {


function insert($dataArray)
{
    if(System::Get('db')->Insert('user',$dataArray))
        return true;

    return false;
}

function update($id,$dataArray)
{
    if(System::Get('db')->Update('user',$dataArray,"WHERE `id`=$id"))
        return true;

    return false;
}

function delete($id)
{
    if(System::Get('db')->Delete('user',"WHERE `id`=$id"))
        return true;

    return false;
}

function select($extra='')
{
    System::Get('db')->Execute("SELECT * FROM `user` $extra");

    if(System::Get('db')->AffectedRows()>0)
        return System::Get('db')->GetRows();

    return [];
}

}