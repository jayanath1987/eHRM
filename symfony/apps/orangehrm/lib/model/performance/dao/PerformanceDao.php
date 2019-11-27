<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage, Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Performance Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class PerformanceDao extends BaseDao {



    public function readDutyGroup($id) {
        return Doctrine::getTable('PerformanceDutyGroup')->find($id);
    }

   
    public function saveDuty(PerformanceDuty $Duty,$request) {

        if (strlen($request->getParameter('txtDutyCode'))) {
                $Duty->setDut_code(trim($request->getParameter('txtDutyCode')));
            } else {
                $Duty->setDut_code(null);
            }
            if (strlen($request->getParameter('txtDutyName'))) {
                $Duty->setDut_name(trim($request->getParameter('txtDutyName')));
            } else {
                $Duty->setDut_name(null);
            }
            if (strlen($request->getParameter('txtDutyNameSi'))) {
                $Duty->setDut_name_si(trim($request->getParameter('txtDutyNameSi')));
            } else {
                $Duty->setDut_name_si(null);
            }
            if (strlen($request->getParameter('txtDutyNameTa'))) {
                $Duty->setDut_name_ta(trim($request->getParameter('txtDutyNameTa')));
            } else {
                $Duty->setDut_name_ta(null);
            }
            if (strlen($request->getParameter('txtDutyDesc'))) {
                $Duty->setDut_desc(trim($request->getParameter('txtDutyDesc')));
            } else {
                $Duty->setDut_desc(null);
            }
            if (strlen($request->getParameter('txtDutyGroupDescSi'))) {
                $Duty->setDut_desc_si(trim($request->getParameter('txtDutyGroupDescSi')));
            } else {
                $Duty->setDut_desc_si(null);
            }
            if (strlen($request->getParameter('txtDutyGroupDescTa'))) {
                $Duty->setDut_desc_ta(trim($request->getParameter('txtDutyGroupDescTa')));
            } else {
                $Duty->setDut_desc_ta(null);
            }
            if (strlen($request->getParameter('cmbDutyGroup'))) {
                $Duty->setDtg_id(trim($request->getParameter('cmbDutyGroup')));
            } else {
                $Duty->setDtg_id(null);
            }
            if (strlen($request->getParameter('cmbRate'))) {
                $Duty->setRate_id(trim($request->getParameter('cmbRate')));
            } else {
                $Duty->setRate_id(null);
            }
        $Duty->save();
        return true;
    }

    public function readSDOEvaluation($id) {
        $exploed = explode("_", $id);
        $query = Doctrine_Query::create()
                ->select('pe.*')
                ->from('PerformanceEvaluationEmployee pe')
                ->where('pe.emp_number= ?', array($exploed[0]))
                ->Andwhere('pe.eval_id= ?', array($exploed[1]));


        return $query->fetchOne();
    }

   

    public function readDutyGroupList() {
        $query = Doctrine_Query::create()
                ->select('dg.*')
                ->from('PerformanceDutyGroup dg');
        return $query->execute();
    }

    public function readRateList() {
        $query = Doctrine_Query::create()
                ->select('r.*')
                ->from('PerformanceRate r');
        return $query->execute();
    }

    
    public function saveRate(PerformanceRate $dg) {
        $dg->save();
        return true;
    }

    public function readRate($id) {
        return Doctrine::getTable('PerformanceRate')->find($id);
    }

   
    

    public function saveEvaluationCompanyInfo(PerformanceEvaluation $EvaluationComInfo,$request) {

            if (strlen($request->getParameter('txtEvaluationCode'))) {
                $EvaluationComInfo->setEval_code(trim($request->getParameter('txtEvaluationCode')));
            } else {
                $EvaluationComInfo->setEval_code(null);
            }
            if (strlen($request->getParameter('txtEvaluationName'))) {
                $EvaluationComInfo->setEval_name(trim($request->getParameter('txtEvaluationName')));
            } else {
                $EvaluationComInfo->setEval_name(null);
            }
            if (strlen($request->getParameter('txtEvaluationNameSi'))) {
                $EvaluationComInfo->setEval_name_si(trim($request->getParameter('txtEvaluationNameSi')));
            } else {
                $EvaluationComInfo->setEval_name_si(null);
            }
            if (strlen($request->getParameter('txtEvaluationNameTa'))) {
                $EvaluationComInfo->setEval_name_ta(trim($request->getParameter('txtEvaluationNameTa')));
            } else {
                $EvaluationComInfo->setEval_name_ta(null);
            }
            if (strlen($request->getParameter('txtEvaluationDesc'))) {
                $EvaluationComInfo->setEval_desc(trim($request->getParameter('txtEvaluationDesc')));
            } else {
                $EvaluationComInfo->setEval_desc(null);
            }
            if (strlen($request->getParameter('txtEvaluationDescSi'))) {
                $EvaluationComInfo->setEval_desc_si(trim($request->getParameter('txtEvaluationDescSi')));
            } else {
                $EvaluationComInfo->setEval_desc_si(null);
            }
            if (strlen($request->getParameter('txtEvaluationDescTa'))) {
                $EvaluationComInfo->setEval_desc_ta(trim($request->getParameter('txtEvaluationDescTa')));
            } else {
                $EvaluationComInfo->setEval_desc_ta(null);
            }
            if (strlen($request->getParameter('cmbYear'))) {
                $EvaluationComInfo->setEval_year(trim($request->getParameter('cmbYear')));
            } else {
                $EvaluationComInfo->setEval_year(null);
            }
            if (strlen($request->getParameter('cmbRate'))) {
                $EvaluationComInfo->setRate_id(trim($request->getParameter('cmbRate')));
            } else {
                $EvaluationComInfo->setRate_id(null);
            }
            if (strlen($request->getParameter('optrate'))) {
                $EvaluationComInfo->setEval_active(trim($request->getParameter('optrate')));
            } else {
                $EvaluationComInfo->setEval_active(null);
            }

        $EvaluationComInfo->save();
        return true;
    }

    public function readEvaluationCompanyInfo($id) {
        return Doctrine::getTable('PerformanceEvaluation')->find($id);
    }

    

    public function readYearList() {
        return $query = range('2000', date('Y') + 20);
    }

    public function getLastRateID() {
        $query = Doctrine_Query::create()
                ->select('MAX(r.rate_id)')
                ->from('PerformanceRate r');

        return $query->fetchArray();
    }

    public function saveRateDetail(PerformanceRateDetails $dg) {
        $dg->save();
        return true;
    }

    

    function readRateDetailList($id,$opt) {

        $query = Doctrine_Query::create()
                ->select('r.rate_id,r.rdt_grade,r.rdt_mark,r.rdt_description')
                ->from('PerformanceRateDetails r')
                ->where("r.rate_id = ?", $id);
                if($opt=='1'){
                  $query->orderBy("r.rdt_mark DESC");  
                }else{
                   $query->orderBy("r.rdt_mark ASC"); 
                }
                


        return $query->fetchArray();
    }

    public function getEvaluationList() {
        $query = Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluation e')
                ->where("e.eval_active = 1");
        return $query->execute();
    }

    public function getEvaluationTypeList() {
        $query = Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluationType e');
        return $query->execute();
    }

    public function getEvaluationYear($id) {
        $query = Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluation e')
                ->where("e.eval_id = ?", $id);
        return $query->fetchArray();
    }

    public function getEmployee($insList = array()) {

        try {
            if (is_array($insList)) {
                $query= Doctrine_Query::create()
                        ->select('e.*')
                        ->from('Employee e')
                        ->whereIn('e.emp_number', $insList);

                return $query->fetchArray();
            }
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function getCompnayStructure($id) {
        try {
            return Doctrine::getTable('CompanyStructure')->find($id);
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    public function getEvaluationEmpList($EVid, $ETId) {
        $query= Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluationEmployee e')
                ->where("e.eval_id = ?", $EVid)
                ->Andwhere("e.eval_type_id = ?", $ETId);
        return $query->fetchArray();
    }

    public function getDeleteEvaluationEmpList($EVid, $ETId, $Enum, $Eval) {
        $query = Doctrine_Query::create()
                ->delete('PerformanceEvaluationEmployee e')
                ->where("e.eval_id = ?", $EVid)
                ->Andwhere("e.eval_type_id = ?", $ETId)
                ->Andwhere("e.emp_number = ?", $Enum)
                ->Andwhere("e.eval_dtl_id = ?", $Eval);
        return $query->execute();
    }

    public function saveEvaluationEmpList(PerformanceEvaluationEmployee $dg) {
        $dg->save();
        return true;
    }

    

    public function getDesignationList() {

        $query = Doctrine_Query::create()
                ->select('j.*')
                ->from('JobTitle j');
        return $query->execute();
    }

    

  

    public function getLevelList() {
        $query = Doctrine_Query::create()
                ->select('l.*')
                ->from('Level l');
        return $query->execute();
    }

    public function getJobRoleList($designation_code, $level_code, $service_code, $flg) {
        $query = Doctrine_Query::create()
                ->select('j.*')
                ->from('JobRole j')
                ->where('j.jobtit_code = ?', $designation_code)
                ->Andwhere('j.level_code= ?', $level_code)
                ->Andwhere('j.service_code = ?', $service_code);
        if ($flg == 0) {
            return $query->execute();
        } else if ($flg == 1) {
            return $query->fetchArray();
        }
    }

    

    public function saveEvaluation(PerformanceEvaluationDetail $dg) {
        $dg->save();
        return true;
    }

    public function readEvaluation($id) {
        return Doctrine::getTable('PerformanceEvaluationDetail')->find($id);
    }

   

    public function getServiceList() {
        $query = Doctrine_Query::create()
                ->select('s.*')
                ->from('ServiceDetails s');
        return $query->execute();
    }

    public function getDutyList() {
        $query = Doctrine_Query::create()
                ->select('pd.*')
                ->from('PerformanceDuty pd')
                ->orderBy('dtg_id');
        return $query->execute();
    }

    public function readEmployee($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    public function LoadsubordinateData($id) {
        $query = Doctrine_Query::create()
                ->select('r.*')
                ->from('ReportTo r')
                ->where('r.erep_sup_emp_number = ?', $id);

        return $query->fetchArray();
    }

    public function LoadSuperviserAllowEvaluation($id) {
        $query = Doctrine_Query::create()
                ->select('s.*')
                ->from('PerformanceEvaluationSupervisor s')
                ->where('s.sup_num = ?', $id);

        return $query->fetchArray();
    }

   

    public function readProjectList($id) {
        $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEmployeeProject p')
                ->where('emp_number =?', $id);
        return $query->execute();
    }

    public function readSDOEMPList($Evalid, $Enum) {
       $query = Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluationEmployee e')
                ->where('e.sup_emp_number =?', $Enum)
                ->Andwhere('e.eval_id =?', $Evalid)
                ->Andwhere('e.eval_type_id =?', "1");
        return $query->execute();
    }

    public function readEvalDetailID($JobTitle, $Level, $Service, $EvalID) {
       $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationDetail p')
                ->where('p.jobtit_code =?', $JobTitle)
                ->Andwhere('p.level_code =?', $Level)
                ->Andwhere('p.service_code =?', $Service)
                ->Andwhere('p.eval_id =?', $EvalID);
        return $query->fetchOne();
    }

    public function readEvalDutyList($id) {
        $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationDuty p')
                ->where('p.eval_dtl_id =?', $id);
        return $query->execute();
    }

    public function readRateDetails($id) {
       $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceRateDetails p')
                ->where('rate_id =?', $id);
        return $query->execute();
    }

    public function savePerformanceEvaluationDuty(PerformanceEvaluationDuty $dg) {
        $dg->save();
        return true;
    }

    public function getLastEvaluationID() {
       $query= Doctrine_Query::create()
                ->select('MAX(e.eval_dtl_id)')
                ->from('PerformanceEvaluationDetail e');
        return $query->fetchArray();
    }

    public function getEvaluationAssignDutyList($eval_id) {
        $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationDuty p')
                ->where("p.eval_dtl_id = ?", $eval_id);
        return $query->execute();
    }

   

    public function getEmployerAssignDuty($eval_id) {
        $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationEmployee p')
                ->where('p.eval_dtl_id =?', $eval_id)
                ->Andwhere('p.eval_emp_status !=?', "0");
        return $query->fetchArray();
    }

    public function saveSDOEvaluation(PerformanceEvaluationEmployee $dg) {
        $dg->save();
        return true;
    }

    public function savePerformanceEvaluationEmployeeProject(PerformanceEvaluationEmployeeProject $dg) {
        $dg->save();
        return true;
    }

    public function deleteEvaluationEmployeeProject($PDID, $Empno, $PID) {
        $query = Doctrine_Query::create()
                ->delete('PerformanceEvaluationEmployeeProject p')
                ->where('p.eval_dtl_id =?', $PDID)
                ->Andwhere('p.emp_number =?', $Empno)
                ->Andwhere('p.eval_prj_id =?', $PID);
        return $query->execute();
    }

    public function savePerformanceEvaluationEmployeeDuty(PerformanceEvaluationEmployeeDuty $dg) {
        $dg->save();
        return true;
    }

    public function deletePerformanceEvaluationEmployeeDuty($PID, $Empno, $DID) {
        $query= Doctrine_Query::create()
                ->delete('PerformanceEvaluationEmployeeDuty p')
                ->where('p.eval_dtl_id =?', $PID)
                ->Andwhere('p.emp_number =?', $Empno)
                ->Andwhere('p.dut_id =?', $DID);
        return $query->execute();
    }

    public function readProjectDetails($id, $Empno, $EvalId) {
        $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationEmployeeProject p')
                ->where('p.eval_dtl_id =?', $EvalId)
                ->Andwhere('p.emp_number =?', $Empno)
                ->Andwhere('p.eval_prj_id =?', $id);

        return $query->fetchOne();
    }

    public function readDutyRateComment($id, $Empno, $EvalId) {
        $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationEmployeeDuty p')
                ->where('p.eval_dtl_id =?', $EvalId)
                ->Andwhere('p.emp_number =?', $Empno)
                ->Andwhere('p.dut_id =?', $id);

        return $query->fetchOne();
    }

    public function SDOProjectRateComment($id, $Empno, $EvalId) {
       $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationEmployee p')
                ->where('p.eval_dtl_id =?', $id)
                ->Andwhere('p.emp_number =?', $Empno)
                ->Andwhere('p.eval_id =?', $EvalId);


        return $query->fetchOne();
    }

    public function readAssignDuty($eval_id, $dut_id) {
        $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationDuty p')
                ->where('p.eval_dtl_id =?', $eval_id)
                ->Andwhere('p.dut_id =?', $dut_id);
        return $query->fetchOne();
    }

    public function getEvaluationSDO($EVid, $ETId, $Enum, $Eval) {
        $query = Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluationEmployee e')
                ->where("e.eval_id = ?", $EVid)
                ->Andwhere("e.eval_type_id = ?", $ETId)
                ->Andwhere("e.emp_number = ?", $Enum)
                ->Andwhere("e.eval_dtl_id = ?", $Eval);
                return $query->fetchOne();
    }

  
    public function readDuty($id) {
        return Doctrine::getTable('PerformanceDuty')->find($id);
    }

    public function getEvaluationSavedEmpList($EVid, $Empnum) {
       $query= Doctrine_Query::create()
                ->select('e.*')
                ->from('PerformanceEvaluationEmployee e')
                ->where("e.eval_id = ?", $EVid)
                ->Andwhere("e.sup_emp_number = ?", $Empnum);
        return $query->fetchArray();
    }

    public function saveEvaluationSupervisor(PerformanceEvaluationSupervisor $dg) {
        $dg->save();
        return true;
    }

    public function readEvaluationSupervisor($eval_id, $empno) {
        $query= Doctrine_Query::create()
                ->select('count(p.emp_number)')
                ->from('PerformanceEvaluationSupervisor p')
                ->where('p.eval_id =?', $eval_id)
                ->Andwhere('p.emp_number =?', $empno);
        return $query->fetchArray();
    }

    public function readAjaxSupervisor($EVid, $Enum, $ESup) {
        $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationEmployee p')
                ->where('p.eval_id =?', $EVid)
                ->Andwhere('p.emp_number =?', $Enum)
                ->Andwhere('p.sup_emp_number =?', $ESup)
                ->Andwhere('p.eval_emp_status =?', "0");
        return $query->fetchOne();
    }

    public function updateEvaluationSupervisor($eval_id, $empno, $Supflag) {
        $query = Doctrine_Query::create()
                ->update('PerformanceEvaluationSupervisor p')
                ->set('p.eval_sup_flag', '?', $Supflag)
                ->where('p.eval_id =?', $eval_id)
                ->Andwhere('p.emp_number =?', $empno);
        $query->execute();
        return true;
    }

    public function SDOEmployee($id, $Empno, $EvalId) {
        $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationEmployee p')
                ->where('p.eval_dtl_id =?', $id)
                ->Andwhere('p.emp_number =?', $Empno)
                ->Andwhere('p.eval_id =?', $EvalId);
        return $query->fetchone();
    }

    public function saveJobRole(PerformanceEvaluationJobRole $pj) {
        $pj->save();
        return true;
    }

    public function deleteJobRole($eval_id, $job_id) {
        $query = Doctrine_Query::create()
                ->delete('PerformanceEvaluationJobRole pj')
                ->where('pj.eval_dtl_id ='. $eval_id)
                ->Andwhere('pj.jrl_id ='. $job_id);
        //die(print_r($query->getSql()));
        return $query->execute();
    }
   
    public function getEvaluationJobRoleList($eval_id) {
        $query = Doctrine_Query::create()
                ->select('pj.*')
                ->from('PerformanceEvaluationJobRole pj')
                ->where("pj.eval_dtl_id = ?", $eval_id);
        return $query->execute();
    }
    
    public function readProjectByUserCode($id){
                $query = Doctrine_Query::create()
                ->select('pj.*')
                ->from('PerformanceEvaluationProject pj')
                ->where("pj.eval_prj_user_code = ?", $id);
        return $query->fetchOne();
    }
    
    public function savePerformanceEvaluationProject(PerformanceEvaluationProject $PerformanceEvaluationProject){
        $PerformanceEvaluationProject->save();
        return true;

    }
    
    public function savePerformanceProjectEmp(PerformanceEmployeeProject $PerformanceEmployeeProject){
        $PerformanceEmployeeProject->save();
        return true;

    }
    
        public function readProjectListByIDEmp($id,$emp) {
        $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEmployeeProject p')
                ->where('eval_prj_id =?', $id)
                ->Andwhere('emp_number =?', $emp);
        return $query->fetchOne();
    }
    public function CheckEvalIdExsist($id){

         $query= Doctrine_Query::create()
                ->select('count(p.eval_id) AS evalCount')
                ->from('PerformanceEvaluationSupervisor p')
                ->where('p.eval_id =?', $id);
               
        return $query->fetchArray();

    }
    public function getEvalEmpListById($id){
         $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationSupervisor p')
                ->innerJoin('p.Employee e p.emp_number=e.emp_number') 
                ->where('p.eval_id =?', $id);

        return $query->execute();
    }

    public function getDirectSupervicerName($id){
         $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('ReportTo p')
                ->where('p.erep_reporting_mode =?', 1)
                 ->andWhere('p.erep_sub_emp_number=?',$id);

        return $query->fetchOne();
    }
    public function readSuperViceData($evalId,$empId){
         $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationSupervisor p')
                ->where('p.eval_id =?', $evalId)
                 ->andWhere('p.emp_number=?',$empId);

        return $query->fetchOne();
    }
    
    public function deleteEmpSupEval($evalId,$ETID){

          $query = Doctrine_Query::create()
                ->delete('PerformanceEvaluationSupervisor e')
                ->where("e.eval_id = ?", $evalId)
                ->andWhere("e.eval_type_id = ?", $ETID);  
          return $query->execute();
    
    }

    public function getEvalEmpListByIdNotInSup($ID,$empArr,$Type){
   
        $comma_separated = implode(",", $empArr);
        
          $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationEmployee p')
                ->innerJoin('p.EmployeeSubordinate e p.emp_number=e.emp_number')
                ->where("p.eval_id = ?", $ID)
                ->andwhere('p.eval_type_id = ?',$Type);
                  if(count($empArr)>0){
                $query->andWhere("p.emp_number NOT IN($comma_separated)");
                  }

                return $query->execute();
    }
     public function isDirectSuperVicer($supId,$subId){
                $query = Doctrine_Query::create()
                ->select('p.*')
                ->from('ReportTo p')
                ->where('p.supervisorId=?',$supId)
                ->andWhere('p.subordinateId=?',$subId)
                ->andWhere('p.reportingMode=1');
                if($query->fetchOne()){
                    return "1";
                }else{
                    return "0";
                }
    }

        public function getEvalEmpListById2($id,$type){
         $query= Doctrine_Query::create()
                ->select('p.*')
                ->from('PerformanceEvaluationSupervisor p')
                ->innerJoin('p.Employee e p.emp_number=e.emp_number') 
                ->where('p.eval_id =?', $id)
                ->andWhere('p.eval_type_id=?',$type);
         $query->orderBy("p.sup_num ASC"); 

        return $query->execute();
    }

    public function readEmployeeEID($id) {
        
         $query= Doctrine_Query::create()
                ->select('e.*')
                ->from('Employee e')
                ->where('e.employeeId =?', $id);
        return $query->fetchOne();
    }


}

?>
