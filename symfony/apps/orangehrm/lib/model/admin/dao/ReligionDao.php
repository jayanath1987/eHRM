<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Religion Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class ReligionDao extends BaseDao {


   public function getReligionList($orderField = 'rlg_code', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('Religion')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }  
}
?>