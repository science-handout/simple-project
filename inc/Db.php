<?php

/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */

$ob = new $table();

class $table {


function insert($dataArray)
{
    if(System::Get('db')->Insert('$table',$dataArray))
        return true;

    return false;
}

function update($id,$dataArray)
{
    if(System::Get('db')->Update('$table',$dataArray,"WHERE `id`=$id"))
        return true;

    return false;
}

function delete($id)
{
    if(System::Get('db')->Delete('$table',"WHERE `id`=$id"))
        return true;

    return false;
}

function select($extra='')
{
    System::Get('db')->Execute("SELECT * FROM `$table` $extra");

    if(System::Get('db')->AffectedRows()>0)
        return System::Get('db')->GetRows();

    return [];
}

}