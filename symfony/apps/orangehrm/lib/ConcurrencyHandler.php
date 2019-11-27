<?php

class ConcurrencyHandler {

    public function __construct(){

    }

    /**
     * Set table lock. Return false if table is currently locked by another user.
     */
    public function setTableLock($tableName, $keyArray, $activityId=1) {

        $tableKey = implode("|",$keyArray);

        $q = Doctrine_Query::create()
          ->select('*')
          ->from('ConcurrencyControl')
          ->where('con_table_name=? and con_table_key=? and con_activity_id=?',array($tableName,$tableKey,$activityId));

        $results = $q->fetchArray();

        if (count($results)==0) {
           
            $conControl = new ConcurrencyControl();
            $conControl->con_table_name=$tableName;
            $conControl->con_table_key=$tableKey;
            $conControl->con_activity_id=$activityId;
            $conControl->con_created_date=date('Y-m-d H:i:s');
            $conControl->con_created_by=$_SESSION['user'];

            $conControl->save();
            
            return true;
        } elseif ($results[0]['con_created_by']==$_SESSION['user']) {
            //Record locked by same user
           
            return true;
        } else {
            
            return false;
        }
    }

    /**
     * Return false if table unlock failed.
     */
    public function resetTableLock($tableName,$keyArray,$activityId) {

        $tableKey = implode("|",$keyArray);

        //Check if table lock is on initiated by the current user
        $q = Doctrine_Query::create()
          ->select('count(*) as record_count')
          ->from('ConcurrencyControl')
          ->where('con_table_name=? and con_table_key=? and con_activity_id=? and con_created_by=?',array($tableName,$tableKey,$activityId,$_SESSION['user']));

        $results = $q->fetchArray();

        if ($results[0]['record_count']==1) {
            $q = Doctrine_Query::create()
              ->delete('ConcurrencyControl')
              ->where('con_table_name=? and con_table_key=? and con_activity_id=?',array($tableName,$tableKey,$activityId));

            $results = $q->execute();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return false if user is allowed to edit/delete.
     */
    public function isTableLocked($tableName, $keyArray, $activityId=1) {

        $tableKey = implode("|",$keyArray);
//         print_r($tableKey);die;
        $q = Doctrine_Query::create()
          ->select('*')
          ->from('ConcurrencyControl')
          ->where('con_table_name=? and con_table_key=? and con_activity_id=?',array($tableName,$tableKey,$activityId));

        $results = $q->fetchArray();

        if (count($results)==0) {
            //Not locked
            return false;
        } elseif ($results[0]['con_created_by']==$_SESSION['user']) {
            //Record locked by same user. Can edit/delete
            return false;
        } else {
            return true;
        }
    }
    
}
?>
