<?php

class AuditTrail {

    public $sqlVariables = array();
    public $connection = null;

    public function __construct(){

    }

    public function getConnection() {

        if (is_null($this->connection)) {
            $this->connection = Doctrine_Manager::getInstance()->getCurrentConnection()->getDbh();
        }

        return $this->connection;
    }

    public function setSqlVariables(){

        if(sizeof($this->sqlVariables)>0){
            $stringArray = array() ;
            foreach ($this->sqlVariables as $key=>$varialble){
                if(strlen($varialble)>0){
                    $stringArray[] = "@".$key."='".$varialble."'";
                }
            }
            
            $this->getConnection()->query("SET ".implode(",",$stringArray).";");
        }
    }

    public function testVar($var) {

        $result = $this->getConnection()->query("SELECT @$var");
        $rows = $result->fetchAll();
        print_r($rows);
    }
}
?>
