<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class DisciplinaryIncidentService extends BaseService {

    private $disciplinaryIncidentDao;

    public function __construct() {
        $this->disciplinaryIncidentDao = new DisciplinaryIncidentDao();
    }

     public function saveIncident($request,$incident) {
        return $this->disciplinaryIncidentDao->saveIncident($request,$incident);
    }
     public function updateIncident($request,$currentIncident) {
        return $this->disciplinaryIncidentDao->updateIncident($request,$currentIncident);
    }
    public function updateIncidentLevel2($request,$currentIncident) {
        return $this->disciplinaryIncidentDao->updateIncidentLevel2($request,$currentIncident);
    }

    public function getMaxIncidentId() {
        return $this->disciplinaryIncidentDao->getMaxIncidentId();
    }

    public function saveInvolvedEmp($invoEmp) {
        return $this->disciplinaryIncidentDao->saveInvolvedEmp($invoEmp);
    }

    public function saveOffenceList(OffenceList $offlist) {
        return $this->disciplinaryIncidentDao->saveOffenceList($offlist);
    }

   

    public function readIncidentByID($id) {
        return $this->disciplinaryIncidentDao->readIncidentByID($id);
    }

    public function getInvolvedEmpListByID($id) {
        return $this->disciplinaryIncidentDao->getInvolvedEmpListByID($id);
    }

    public function Loadoffence($id) {
        return $this->disciplinaryIncidentDao->Loadoffence($id);
    }

    public function readOffenceList($id) {
        return $this->disciplinaryIncidentDao->readOffenceList($id);
    }

    public function checkChargeSheet($id, $type) {
        return $this->disciplinaryIncidentDao->checkChargeSheet($id, $type);
    }

    public function readChargeSheet($id, $type) {
        return $this->disciplinaryIncidentDao->readChargeSheet($id, $type);
    }

    public function saveDisAttachment(DisAttachment $attach) {
        return $this->disciplinaryIncidentDao->saveDisAttachment($attach);
    }

    public function deleteOffenceList($incId) {
        return $this->disciplinaryIncidentDao->deleteOffenceList($incId);
    }

    public function updatedisemp($id, $eno, $majmin, $type) {
        return $this->disciplinaryIncidentDao->updatedisemp($id, $eno, $majmin, $type);
    }

   

    


    
}
?>
