<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CustomImportService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class CustomImportService extends BaseService {

   private $customImportDao;


   public function  __construct() {
      $this->customImportDao = new CustomImportDao();
   }


   public function setCustomImportDao(CustomImportDao $customImportDao) {
      $this->customImportDao = $customImportDao;
   }


   public function getCustomImportDao() {
      return $this->customImportDao;
   }


   public function getCustomImportList($orderField = 'import_id', $orderBy = 'ASC') {

         return $this->customImportDao->getCustomImportList($orderField, $orderBy);

   }


   public function saveCustomImport(CustomImport $customImport) {

         return $this->customImportDao->saveCustomImport($customImport);

   }


   public function readCustomImport($id) {

         return $this->customImportDao->readCustomImport($id);

   }


   public function searchCustomImport($field, $value) {

         return $this->customImportDao->searchCustomImport($field, $value);

   }


   public function deleteCustomImport($id) {

         return $this->customImportDao->deleteCustomImport($id);

   }


   public static function getAllFields()
   {

         return CustomExportService::getAllFields();

   }
}
?>
