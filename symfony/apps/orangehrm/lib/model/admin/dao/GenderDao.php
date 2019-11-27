<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Gender Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class GenderDao extends BaseDao {


   public function getGenderList($orderField = 'gender_code', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('Gender')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }  
}
?>