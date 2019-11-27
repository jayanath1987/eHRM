<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CustomImport Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class CustomImportDao extends BaseDao {


   public function getCustomImportList($orderField = 'import_id', $orderBy = 'ASC') {

         $q = Doctrine_Query::create()
			    ->from('CustomImport ci')
			    ->orderBy($orderField . ' ' . $orderBy);

			$importList = $q->execute();
			return  $importList;


   }


   public function saveCustomImport(CustomImport $customImport) {

         $customImport->save();
         return true;

   }


   public function readCustomImport($id) {

         $q = Doctrine_Query::create()
			    ->from('CustomImport')
			    ->where("import_id = ?", $id);

			$customImport = $q->fetchOne();
         return $customImport;


   }


   public function searchCustomImport($field, $value) {

         $q = Doctrine_Query::create()
             ->from('CustomImport')
             ->where($field . " = ?", $value);

         $importList = $q->execute();
			return $importList;


   }


   public function deleteCustomImport($id) {

         $q = 	Doctrine_Query::create()
				->delete('CustomImport')
				->where('import_id = ?', $id);

         $numDeleted = $q->execute();
         if($numDeleted > 0) {
            return true;
         }
         return false;

   }
}
?>