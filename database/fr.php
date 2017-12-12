<?php

/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */

$fr = new fr();

class fr {


function insert($dataArray)
{
    if(System::Get('db')->Insert('fr',$dataArray))
        return true;

    return false;
}

function update($id,$dataArray)
{
    if(System::Get('db')->Update('fr',$dataArray,"WHERE `id`=$id"))
        return true;

    return false;
}

function delete($id)
{
    if(System::Get('db')->Delete('fr',"WHERE `id`=$id"))
        return true;

    return false;
}

function select($extra='')
{
    System::Get('db')->Execute("SELECT * FROM `fr` $extra");

    if(System::Get('db')->AffectedRows()>0)
        return System::Get('db')->GetRows();

    return [];
}

}