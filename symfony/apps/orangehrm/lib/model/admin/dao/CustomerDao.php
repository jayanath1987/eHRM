<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Customer Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class CustomerDao extends BaseDao {


   public function getCustomerList($orderField = 'customer_id', $orderBy = 'ASC') {

	    	$q = Doctrine_Query::create()
			    ->from('Customer')
			    ->where('deleted = ?', 0)
			    ->orderBy($orderField.' '.$orderBy);

			return $q->execute();

    }


    public function saveCustomer(Customer $customer) {

         $q = Doctrine_Query::create()
			    ->from('Customer m')
             ->where('m.name = ?', $customer->name);

	    	if(!empty($customer->customer_id)) {
            $q->andWhere('m.customer_id <> ?', $customer->customer_id) ;
         }

         if ($q->count() > 0) {
            throw new DataDuplicationException("Cannot save customer due to saving duplicated data");
         }

			if($customer->getCustomerId() == '') {
	        	$idGenService	=	new IDGeneratorService();
				$idGenService->setEntity($customer);
				$customer->setCustomerId($idGenService->getNextID());
			}
        	$customer->save();
        	return true ;

   }


   public function deleteCustomer($customerList = array()) {

         if(is_array($customerList)) {
	        	$q = Doctrine_Query::create()
					    ->update('Customer')
                   ->set('deleted', '?', true)
					    ->whereIn('customer_id', $customerList );

				$numDeleted = $q->execute();
            if($numDeleted > 0) {
               return true;
            }
				return false;
	    	}

   }


   public function searchCustomer($searchMode, $searchValue) {

        	$q = 	Doctrine_Query::create( )
				->from('Customer')
				->where("$searchMode = ?", trim($searchValue));

			return $q->execute();

   }


   public function readCustomer($id) {

         return Doctrine::getTable('Customer')->find($id);

   }
}
?>
