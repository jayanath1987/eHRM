<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CustomFields Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class CustomFieldsDao extends BaseDao {


   public function getCustomFieldList($orderField = "field_num", $orderBy = "ASC") {

         $q = Doctrine_Query::create()
            ->from('CustomFields')
            ->orderBy($orderField.' '.$orderBy);
         return $q->execute();

   }


   public function saveCustomField(CustomFields $customFields) {

	    	$q = Doctrine_Query::create()
			    ->from('CustomFields c')
             ->where('c.name = ?', $customFields->name)
             ->andWhere('c.field_num <> ?', $customFields->field_num);

         if ($q->count() > 0) {
            throw new DataDuplicationException("Saving CustomFields failed due to saving of dupliced data");
         }

        	$customFields->save();
         return true;

   }


   public function deleteCustomField($customFieldList = array()) {

         if(is_array($customFieldList)) {
	        	$q = Doctrine_Query::create()
					    ->delete('CustomFields')
					    ->whereIn('field_num', $customFieldList  );

				$numDeleted = $q->execute();
            if($numDeleted > 0) {
               return true;
            }
	    	}
         return false;

   }


   public function readCustomField($id) {

	    	return Doctrine::getTable('CustomFields')->find($id);

   }
}
?>
