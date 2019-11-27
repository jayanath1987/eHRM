<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CustomerService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class CustomerService extends BaseService {
   private $customerDao;


   public function __construct() {
      $this->customerDao = new CustomerDao();
   }


   public function setCustomerDao(CustomerDao $customerDao) {
      $this->customerDao = $customerDao;
   }


   public function getCustomerDao() {
      return $this->customerDao;
   }


   public function getCustomerList($orderField = 'customer_id', $orderBy = 'ASC') {

         return $this->customerDao->getCustomerList($orderField, $orderBy);

   }


    public function saveCustomer(Customer $customer) {

         return $this->customerDao->saveCustomer($customer);

    }


   public function deleteCustomer($customerList = array()) {

         return $this->customerDao->deleteCustomer($customerList);

   }

   public function searchCustomer($searchMode, $searchValue) {

         return $this->customerDao->searchCustomer($searchMode, $searchValue);

   }


   public function readCustomer($id) {

         return $this->customerDao->readCustomer($id);

   }
}
?>