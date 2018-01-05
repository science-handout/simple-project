<?php
/**
 * DB SYSTEM
 * Description of pdo
 *
 * @author mohamed amr
 */

class PdoDB implements DB{

    private $connection;
    private $last; //last query [result]

    public function __construct() {
        $this->dbconnect();
        $this->Execute('SET NAMES utf8');
    }

    public function dbconnect()
    {

        $this->connection = new PDO(DBTYPE.":host=".HOST.";dbname=".DBNAME,USER,PASS);
        if($this->connection)
            return TRUE;

        return FALSE;

    }

    public function Execute($query)
    {
        if($result = $this->connection->prepare($query))
        {
            $result->execute();
            $this->last = $result;
            return TRUE;
        }
        return FALSE;
    }

    public function Execute_Multi($query)
    {
        // TODO: Implement Execute_Multi() method.
    }

    public function GetRows()
    {

        $result = array();

        $rows   = $this->NumRows();

        for($i = 0;$i<$rows;$i++)
        {
            $result[] = $this->last->fetch(PDO::FETCH_ASSOC);

        }
        if(count($result) > 0)
            return $result;

        $this->last->free();

        return NULL;

    }

    public function GetRow()
    {
        $result = array();

        $rows   = $this->NumRows();

        for($i = 0;$i<$rows;$i++)
        {
            $result[] = $this->last->fetch(PDO::FETCH_ASSOC);

        }
        if(count($result) > 0)
            return $result[0];

        $this->last->free();

        return NULL;
    }

    public function NumRows()
    {
        return $this->last->rowCount();
    }

    public function AffectedRows()
    {
        return $this->last->rowCount();
    }

    public function Select_Count($table)
    {
        // TODO: Implement Select_Count() method.
    }

    public function Insert($table, $data)
    {
        $fields  = '';
        $values = '';
        // populate them
        foreach ($data as $f => $v)
        {
            $fields  .= "`$f`,";
            $values .= ( is_numeric( $v ) && ( intval( $v ) == $v ) ) ? $v."," : "'$v',";
        }

        // remove our trailing ,
        $fields = substr($fields, 0, -1);
        // remove our trailing ,
        $values = substr($values, 0, -1);

        $querystring = "INSERT INTO `{$table}` ({$fields}) VALUES({$values})";
        //echo $querystring;
        //Check If Row Inserted
        if($this->Execute($querystring))
            return TRUE;

        return FALSE;
    }

    public function Delete($from, $where)
    {
        $query = sprintf('DELETE FROM `%s` %s',$from,$where);
        // echo $query;
        $result = $this->Execute($query);
        if($result && $this->AffectedRows()>0)
            return TRUE;

        return FALSE;
    }

    public function Update($table, $data, $where = '')
    {
        //set $key = $value :)

        $query  = '';
        foreach ($data as $f => $v) {
            (is_numeric($v) && intval($v) == $v || is_float($v))? $v."," : "'$v' ,";
            $query  .= "`$f` = '{$v}' ,";
        }

        //Remove trailing ,
        $query = substr($query, 0,-1);

        $querystring = "UPDATE `{$table}` SET {$query} {$where}";
        //echo $querystring;
        $update = $this->Execute($querystring);
        if($update)
            return TRUE;

        return FALSE;
    }

    public function Last()
    {
        return $this->connection()->lastInsertId();
    }

    public function getDBErrors()
    {
        return $this->connection->errorInfo();
    }

    public function __destruct()
    {
        unset($this->connection);
    }
}