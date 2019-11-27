<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module User Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class userDao extends BaseDao {


    public function readUser($id){

         return Doctrine::getTable('Users')->find($id);

    }
    public function saveUser(Users $user){

        $user->save();
    }
    public function getButtonSecurity($menuId){
        
         $q = Doctrine_Query::create()
        ->select('m.*,c.*')
        ->from('menuitem m')
        ->leftjoin('m.mnucapability c ')
        ->leftjoin('c.capability cp on c.sm_capability_id=cp.sm_capability_id')
         ->leftjoin('cp.Users u on u.sm_capability_id=cp.sm_capability_id')
        ->where('m.sm_mnuitem_id= ?',$menuId)
         ->andwhere('u.id= ?', $_SESSION['user']);

       

        return $q->fetchArray();
    }

}
 
?>
