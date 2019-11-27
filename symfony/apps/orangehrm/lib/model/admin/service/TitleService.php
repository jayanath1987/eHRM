<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module TitleService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class TitleService extends BaseService {
   private $titleDao;


   public function __construct() {
      $this->titleDao = new TitleDao();
   }


   public function getTitleList($orderField = 'title_code', $orderBy = 'ASC') {
        return $this->titleDao->getTitleList($orderField, $orderBy);
   }   
}
?>