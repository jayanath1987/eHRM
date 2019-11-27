<?php
if($_POST){
    //print_r($_POST);
    foreach ($_POST['txt_emp_ts_id_'] as $row){
        
        $host="localhost"; // Host name
        $username="root"; // Mysql username
        $password=""; // Mysql password
        $db_name="ictahrmlive"; // Database name
        $tbl_name="hs_hr_evl_ts_emp"; // Table name
        
        mysql_connect("$host", "$username", "$password")or die("cannot connect");
        mysql_select_db("$db_name")or die("cannot select DB");
        
        $sql2="UPDATE $tbl_name SET emp_ts_marks_client_".$_POST['clientid']." = '".$_POST['txt_'.$row]."', emp_ts_send_url_client_".$_POST['clientid']." = '2' WHERE emp_ts_id =".$row;
        //die(print_r($sql2));
        $result2=mysql_query($sql2);

        mysql_close();
        
    }
    
   echo "Thank you for your support";
   header('Refresh: 3; url=http://www.icta.lk');
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
