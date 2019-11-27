<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class DisciplinaryTypeOffenceService extends BaseService {

    private $disciplinaryTypeOffenceDao;

    public function __construct() {
        $this->disciplinaryTypeOffenceDao = new DisciplinaryTypeOffenceDao();
    }
    

    public function saveActiontype(DisciplinaryActionType $disaction) {
        return $this->disciplinaryTypeOffenceDao->saveActiontype($disaction);
    }

    public function getLastActiontype() {
        return $this->disciplinaryTypeOffenceDao->getLastActiontype();
    }

   public function readActiontype($id) {
        return $this->disciplinaryTypeOffenceDao->readActiontype($id);
    }

  

   public function searchOffence($searchMode, $searchValue, $culture, $page, $orderField, $orderBy) {
        return $this->disciplinaryTypeOffenceDao->searchOffence($searchMode, $searchValue, $culture, $page, $orderField, $orderBy);
    }

    public function saveOffence(Offence $offence) {
        return $this->disciplinaryTypeOffenceDao->saveOffence($offence);
    }
    public function updateOffence($request,$obj) {
        return $this->disciplinaryTypeOffenceDao->updateOffence($request,$obj);
    }


    public function getLastoffecnce() {
        return $this->disciplinaryTypeOffenceDao->getLastoffecnce();
    }

   public function readOffence($id) {
        return $this->disciplinaryTypeOffenceDao->readOffence($id);
    }

  public function deleteOffence($id) {
      return $this->disciplinaryTypeOffenceDao->deleteOffence($id);
  }

    public function getActiontypes() {
      return $this->disciplinaryTypeOffenceDao->getActiontypes();
  }
    

    public function saveFinalAction(DisiplinaryFinalAction $DisiplinaryFinalAction) {
        return $this->disciplinaryTypeOffenceDao->saveFinalAction($DisiplinaryFinalAction);
    }


   public function readFinalAction($id) {
        return $this->disciplinaryTypeOffenceDao->readFinalAction($id);
    }

  public function deleteFinalAction($id) {
      return $this->disciplinaryTypeOffenceDao->deleteFinalAction($id);
  }

   public function getFinalActiontypes() {
      return $this->disciplinaryTypeOffenceDao->getFinalActiontypes();
  }
  
  public function getFinalActiontypesfiltered($type) {
      return $this->disciplinaryTypeOffenceDao->getFinalActiontypesfiltered($type);
  }


}

?>
