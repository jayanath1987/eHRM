<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module ExportImportFieldsService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class ExportImportFieldsService
{
   private static $fields     = null;
   private static $configFile = null;


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