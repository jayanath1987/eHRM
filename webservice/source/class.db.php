<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Dbconn {

    private $dbName;
    private $dbUser;
    private $dbPass;
    private $host;

    function Dbconn($host, $db, $user, $pass) {

// we connect to example.com and port 3307
        $link = mysql_connect($host, $user, $pass);
        if (!$link) {
            die('Could not connect: ' . mysql_error());
        }

        $db_selected = mysql_select_db($db, $link);
        if (!$db_selected) {
            die ('Can\'t use "{$db}" : ' . mysql_error());
        }
        else{
            mysql_set_charset('utf8');
            //echo "Connected";
        }
 

    }

}

?>
