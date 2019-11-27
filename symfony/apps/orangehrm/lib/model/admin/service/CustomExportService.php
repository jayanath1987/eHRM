<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CustomExportService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class CustomExportService extends BaseService {

   private static $fields     = null;
   private static $configFile = null;
   private $customExportDao;


   public function __construct() {
      $this->customExportDao = new CustomExportDao();
   }


   public function setCustomExportDao(CustomExportDao $customExportDao) {
      $this->customExportDao = $customExportDao;
   }


   public function getCustomExportDao() {
      return $this->customExportDao;
   }


   public function getCustomExportList($orderField = 'export_id', $orderBy = 'ASC') {

         return $this->customExportDao->getCustomExportList($orderField, $orderBy);

   }


   public function saveCustomExport(CustomExport $customExport) {

         return $this->customExportDao->saveCustomExport($customExport);

   }


   public function readCustomExport($id) {

         return $this->customExportDao->readCustomExport($id);

   }


   public function searchCustomExport($field, $value) {

         return $this->customExportDao->searchCustomExport($field, $value);

   }


   public function deleteCustomExport($id) {

         return $this->customExportDao->deleteCustomExport($id);

   }


   public static function getAllFields() {
      if(is_null(self::$fields)) {
         self::$configFile = sfConfig::get('sf_apps_dir') . '/orangehrm/modules/admin/config/customExportImportFields.yml';

         if(!file_exists(self::$configFile))
            throw new FileNotFoundException("Configuration file not found in the path : ". self::$configFile);

         self::$fields     = sfYaml::load(self::$configFile);
      }
      return self::$fields;
   }
   
}
?>
