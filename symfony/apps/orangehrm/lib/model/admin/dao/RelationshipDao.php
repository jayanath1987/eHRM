<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Relationship Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class RelationshipDao extends BaseDao {


   public function getRelationshipList($orderField = 'rel_code', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('EmpRelationship')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }  
}
?>