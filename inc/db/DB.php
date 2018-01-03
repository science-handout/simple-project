<?php
/**
 * DB SYSTEM
 * interface database
 * @author mohamed amr
 */
interface DB {

    public function dbconnect();
    public function Execute($query);
    public function Execute_Multi($query);
    public function GetRows();
    public function GetRow();
    public function NumRows();
    public function AffectedRows();
    public function Select_Count($table);
    public function Insert($table,$data);
    public function Delete($from,$where);
    public function Update($table,$data,$where='');
    public function Last();
    public function getDBErrors();
    public function __destruct();


}