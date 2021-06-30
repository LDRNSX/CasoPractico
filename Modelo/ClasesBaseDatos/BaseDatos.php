<?php
require_once "DBConfig.php";

class BaseDatos extends DBConfig{
    /*protected*/ function __construct($DBName){
        parent::__construct($DBName);
        $this->pConnection->query("SET NAMES 'utf8'");
    } // end of member function __construct

    /*protected*/ function getData( $query){
        $result = $this->pConnection->query($query);
        if($result== false) {
            return false;
        } //END IF
        $rows = array();
        while($row = $result->fetch_assoc()) {
        $rows[] = $row;
        } //END WHILE
        return $rows;
    } // end of member function getData

    /*protected*/ function execute( $query){
        $result = $this->pConnection->query($query);
        if($result == false) {
            echo "<h1>Error: no se ha podido ejecutar $query </h1>" . PHP_EOL;
            return false;
        } else {
            return true;
        } // END IF
    } // end of member function execute
} // end of BaseDatos
?> 