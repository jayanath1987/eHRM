<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Roshan
 *  On (Date) - 10 Oct 2011
 *  Comments  - Performance Module Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class PerformanceSaveDao extends BaseDao {


public function saveDutyGroup(PerformanceDutyGroup $dg) {
        $dg->save();
        return true;
    }

 public function deleteDutyGroup($id) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceDutyGroup')
                ->where('dtg_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

     public function deleteDuty($id) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceDuty')
                ->where('dut_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteRateDetail($id) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceRateDetails')
                ->where('rate_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

     public function deleteRate($id) {

        $q = Doctrine_Query::create()
                ->delete('PerformanceRate')
                ->where('rate_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteEvaluationCompanyInfo($id) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceEvaluation')
                ->where('eval_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

     public function deleteAssignDuty($eval_id, $dut_id) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceEvaluationDuty p')
                ->where('p.eval_dtl_id =?', $eval_id)
                ->Andwhere('p.dut_id =?', $dut_id);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteEmployeeProject($PDID, $Empno) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceEvaluationEmployeeProject p')
                ->where('p.eval_dtl_id =?', $PDID)
                ->Andwhere('p.emp_number =?', $Empno);

        return $q->execute();
    }

      public function deleteEmployeeDuty($PID, $Empno) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceEvaluationEmployeeDuty p')
                ->where('p.eval_dtl_id =?', $PID)
                ->Andwhere('p.emp_number =?', $Empno);
        return $q->execute();
    }

      public function deleteAssingEmployee($eno, $eval) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceEvaluationEmployee')
                ->where('eval_id=' . $eval)
                ->Andwhere('emp_number=' . $eno);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }
     public function deleteEvaluation($id) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceEvaluationDetail')
                ->where('eval_dtl_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

     public function deleteJobRole($eval_id, $job_id) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceEvaluationJobRole pj')
                ->where('pj.eval_dtl_id =?', $eval_id)
                ->Andwhere('pj.jrl_id =?', $job_id);
        return $q->execute();
    }
    public function getRatesObj($request, $Rate) {

          if (strlen($request->getParameter('txtRateCode'))) {
                    $Rate->setRate_code(trim($request->getParameter('txtRateCode')));
                } else {
                    $Rate->setRate_code(null);
                }
                if (strlen($request->getParameter('txtRateName'))) {
                    $Rate->setRate_name(trim($request->getParameter('txtRateName')));
                } else {
                    $Rate->setRate_name(null);
                }
                if (strlen($request->getParameter('txtRateNameSi'))) {
                    $Rate->setRate_name_si(trim($request->getParameter('txtRateNameSi')));
                } else {
                    $Rate->setRate_name_si(null);
                }
                if (strlen($request->getParameter('txtRateNameTa'))) {
                    $Rate->setRate_name_ta(trim($request->getParameter('txtRateNameTa')));
                } else {
                    $Rate->setRate_name_ta(null);
                }
                if (strlen($request->getParameter('txtRateDesc'))) {
                    $Rate->setRate_desc(trim($request->getParameter('txtRateDesc')));
                } else {
                    $Rate->setRate_desc(null);
                }
                if (strlen($request->getParameter('txtRateDescSi'))) {
                    $Rate->setRate_desc_si(trim($request->getParameter('txtRateDescSi')));
                } else {
                    $Rate->setRate_desc_si(null);
                }
                if (strlen($request->getParameter('txtRateDescTa'))) {
                    $Rate->setRate_desc_ta(trim($request->getParameter('txtRateDescTa')));
                } else {
                    $Rate->setRate_desc_ta(null);
                }
                if (strlen($request->getParameter('optrate'))) {
                    $Rate->setRate_option(trim($request->getParameter('optrate')));
                } else {
                    $Rate->setRate_option(null);
                }

                return $Rate;


    }

    public function GetUpdateRateObj($request, $Rate) {

                if (strlen($request->getParameter('txtRateCode'))) {
                    $Rate->setRate_code(trim($request->getParameter('txtRateCode')));
                } else {
                    $Rate->setRate_code(null);
                }
                if (strlen($request->getParameter('txtRateName'))) {
                    $Rate->setRate_name(trim($request->getParameter('txtRateName')));
                } else {
                    $Rate->setRate_name(null);
                }
                if (strlen($request->getParameter('txtRateNameSi'))) {
                    $Rate->setRate_name_si(trim($request->getParameter('txtRateNameSi')));
                } else {
                    $Rate->setRate_name_si(null);
                }
                if (strlen($request->getParameter('txtRateNameTa'))) {
                    $Rate->setRate_name_ta(trim($request->getParameter('txtRateNameTa')));
                } else {
                    $Rate->setRate_name_ta(null);
                }
                if (strlen($request->getParameter('txtRateDesc'))) {
                    $Rate->setRate_desc(trim($request->getParameter('txtRateDesc')));
                } else {
                    $Rate->setRate_desc(null);
                }
                if (strlen($request->getParameter('txtRateDescSi'))) {
                    $Rate->setRate_desc_si(trim($request->getParameter('txtRateDescSi')));
                } else {
                    $Rate->setRate_desc_si(null);
                }
                if (strlen($request->getParameter('txtRateDescTa'))) {
                    $Rate->setRate_desc_ta(trim($request->getParameter('txtRateDescTa')));
                } else {
                    $Rate->setRate_desc_ta(null);
                }
                if (strlen($request->getParameter('optrate'))) {
                    $Rate->setRate_option(trim($request->getParameter('optrate')));
                } else {
                    $Rate->setRate_option(null);
                }

                return $Rate;

    }
    
     public function deleteAssingSuperEmployee($eno, $eval) {
        $q = Doctrine_Query::create()
                ->delete('PerformanceEvaluationSupervisor')
                ->where('eval_id=' . $eval)
                ->Andwhere('emp_number=' . $eno);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    
}
?>
