<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Titles Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class TitleDao extends BaseDao {


   public function getTitleList($orderField = 'title_code', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('EmpTitle')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }  
}
?>