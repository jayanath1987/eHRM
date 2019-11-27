<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CustomExport Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class CustomExportDao extends BaseDao {


   public function getCustomExportList($orderField = 'export_id', $orderBy = 'ASC') {


         $q = Doctrine_Query::create()
			    ->from('CustomExport ce')
			    ->orderBy($orderField . ' ' . $orderBy);

			$exportList = $q->execute();
			return  $exportList;


   }


   public function saveCustomExport(CustomExport $customExport) {

         $customExport->save();
         return true;

   }


   public function readCustomExport($id) {

         $q = Doctrine_Query::create()
			    ->from('CustomExport')
			    ->where("export_id = ?", $id);

			$customExport = $q->fetchOne();
         return $customExport;


   }


   public function searchCustomExport($field, $value) {

         $q = Doctrine_Query::create()
             ->from('CustomExport')
             ->where($field . " = ?", $value);

         $exportList = $q->execute();
			return $exportList;


   }


   public function deleteCustomExport($id) {

         $q = 	Doctrine_Query::create()
				->delete('CustomExport')
				->where('export_id = ?', $id);

         $numDeleted = $q->execute();
         if($numDeleted > 0) {
            return true;
         }
         return false;

   }
}
?>