<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class retirementService extends BaseService {
   private $retirementDao;

   /**
    * Constructor
    */
   public function __construct() {
      $this->retirementDao = new retirementDao();
   }
}

?>
