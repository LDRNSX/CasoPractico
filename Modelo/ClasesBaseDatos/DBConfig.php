<?php
class DBConfig{
    const SERVER = "localhost";
    const DBUSER = "root";
    const PSSWRD = "";
    public $pDBName;
    public $pConnection;
    
    /*protected*/ function __construct($DBName){
        $this->pDBName=$DBName;
        if(!isset($this->pConnection)) {
            $this->pConnection = new mysqli(self::SERVER, self::DBUSER, self::PSSWRD, $this->pDBName);
            if(!$this->pConnection) {
                echo "<h1>Error, no se ha podido conectar con la base de datos</h1>" . PHP_EOL;
                exit;
            } // END IF
        } // END IF
    } // end of member function __construct
} // end of DBConfig
