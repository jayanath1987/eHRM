<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class transferService extends BaseService {
   private $trainingDao;

   public function __construct() {
      $this->trainingDao = new TrainingDao();
   }
   public function setTransferDao(TrainingDao $trainingDao) {
      $this->trainingDao = $trainingDao;
   }

   /**
    * Return JobDao
    * @returns JobDao
    */
   public function getTransferDao() {
      return $this->trainingDao;
   }
   


}

?>
