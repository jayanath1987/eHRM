<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CurrencyService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class CurrencyService extends BaseService {

   private $currencyDao;


   public function  __construct() {
      $this->currencyDao = new CurrencyDao();
   }


   public function setCurrencyDao(CurrencyDao $currencyDao) {
      $this->currencyDao = $currencyDao;
   }


   public function getCurrencyDao($param) {
      return $this->currencyDao;
   }


   public function getCurrencyList() {

         return $this->currencyDao->getCurrencyList();

   }
}
?>