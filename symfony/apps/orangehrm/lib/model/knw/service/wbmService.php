<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class wbmService extends BaseService {
   private $wbmDao;

   /**
    * Constructor
    */
   public function __construct() {
      $this->wbmDao = new wbmDao();
   }

}
?>
