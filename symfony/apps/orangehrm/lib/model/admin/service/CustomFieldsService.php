<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CustomFieldsService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class CustomFieldsService extends BaseService {
	//not sure of the business purpose of the constants, need to check their references
   const FIELD_TYPE_STRING			=	0 ;
   const FIELD_TYPE_DROP_DOWN		=	1 ;
   const NUMBER_OF_FIELDS			=	10 ;

   private $customFieldsDao;
   

   public function __construct() {
      $this->customFieldsDao = new CustomFieldsDao();
   }


   public function setCustomFieldsDao(CustomFieldsDao $customFieldsDao) {
      $this->customFieldsDao = $customFieldsDao;
   }


   public function getCustomFieldsDao() {
      return $this->customFieldsDao;
   }


   public function getCustomFieldList($orderField = "field_num", $orderBy = "ASC") {

         return $this->customFieldsDao->getCustomFieldList($orderField, $orderBy);

    } 
    

   public function saveCustomField(CustomFields $customFields) {

         return $this->customFieldsDao->saveCustomField($customFields);

   }
    

   public function deleteCustomField($customFieldList) {

         return $this->customFieldsDao->deleteCustomField($customFieldList);

   }
    

   public function readCustomField($id123) {

         return $this->customFieldsDao->readCustomField($id123);

   }
    

   public function getAvailableFieldNumbers() {

        	$availableFields	=	array();

			$customFieldList = $this->getCustomFieldList();
			for( $i=1 ; $i<= self::NUMBER_OF_FIELDS ; $i++) {
				$avaliabe	=	true; 
				foreach( $customFieldList as $customField) {
					if($customField->getFieldNum() == $i ) {
						$avaliabe	=	false; 
					}
				}
				if( $avaliabe )
					array_push($availableFields,$i);			
			}
			
			return $availableFields;

   }
}
?>