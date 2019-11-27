<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module RelationshipService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class RelationshipService extends BaseService {
   private $relationshipDao;


   public function __construct() {
      $this->relationshipDao = new RelationshipDao();
   }


   public function getRelationshipList($orderField = 'rel_code', $orderBy = 'ASC') {
        return $this->relationshipDao->getRelationshipList($orderField, $orderBy);
   }   
}
?>