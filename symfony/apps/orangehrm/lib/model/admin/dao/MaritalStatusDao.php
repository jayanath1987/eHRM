<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module MaritalStatus Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class MaritalStatusDao extends BaseDao {


   public function getMaritalStatusList($orderField = 'marst_code', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('MaritalStatus')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }  
}
?>