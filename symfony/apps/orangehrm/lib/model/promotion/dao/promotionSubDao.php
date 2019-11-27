<?php

/**
 * Actions class for Promotion Module
 *
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 18 September 2011
 *  Comments  - Employee Promotion Functions
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class promotionSubDao extends BaseDao {
    public function getPromotionList($searchMode, $searchValue, $culture='en', $orderField = 'p.prm_id', $orderBy = 'ASC', $page = 1) {


                if ($searchMode == "prm_effective_date") {
                $q = Doctrine_Query::create()
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number')
                                ->where("p.prm_effective_date LIKE ?", '%' . trim($searchValue) . '%')
                                ->orderBy($orderField . ' ' . $orderBy);
            } else if ($searchMode == "prm_method_comment_") {
                $searchMode = "prm_method_comment_" . $culture;

                $q = Doctrine_Query::create()
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number')
                                ->where("pm.prm_method_comment_" . $culture . " LIKE ?", '%' . trim($searchValue) . '%')
                                ->orderBy($orderField . ' ' . $orderBy);
            } else if ($searchMode == "empid") {
                $q = Doctrine_Query::create()
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number')
                                ->where("p.emp_number = ?", $searchValue)
                                ->orderBy($orderField . ' ' . $orderBy);
            } else if ($searchMode == "emp_display_name_") {
                if($culture==en){
                    $fieild='e.emp_display_name';
                }else{
                    $fieild='e.emp_display_name_' . $culture;
                }

                $q = Doctrine_Query::create()
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number')
                                ->where($fieild . " LIKE ?", '%' . trim($searchValue) . '%')
                                ->orderBy($orderField . ' ' . $orderBy);
            } else {
                $q = Doctrine_Query::create()
                                ->select('p.*')
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number')
                                ->orderBy($orderField . ' ' . $orderBy);
            }
            $sysConf = new sysConf();
            $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

            // Pager object
            $pagerLayout = new CommonhrmPager(
                            new Doctrine_Pager(
                                    $q,
                                    $page,
                                    $resultsPerPage
                            ),
                            new Doctrine_Pager_Range_Sliding(array(
                                'chunk' => 5
                            )),
                            "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;

    }

     public function deleteImage($id) {

        $q = Doctrine_Query::create()
                        ->update('Promotion p')
                        ->set('p.prm_promotion_letter', '?', "")
                        ->where('p.prm_id = ?', $id);

        $q->execute();
        return true;
    }

    public function getPromotionReasonList($searchMode, $searchValue, $culture='en', $orderField, $orderBy = 'ASC', $page = 1) {
        try {


            $q = Doctrine_Query::create()
                            ->select('r.*')
                            ->from('PromotionMethod r');

            if ($searchValue != "") {
                switch ($searchMode) {
                    case "prm_method_comment":
                        $feildName = "r.prm_method_comment_" . $culture;
                        break;
                }
                $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
            }
            $q->orderBy($orderField . ' ' . $orderBy);

            $sysConf = new sysConf();
            $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

            // Pager object
            $pagerLayout = new CommonhrmPager(
                            new Doctrine_Pager(
                                    $q,
                                    $page,
                                    $resultsPerPage
                            ),
                            new Doctrine_Pager_Range_Sliding(array(
                                'chunk' => 5
                            )),
                            "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }


    public function deleteAttach($id) {

        $q = Doctrine_Query::create()
                        ->delete('PromotionAttachment t')
                        ->where('t.prm_id = ?', $id);

        $q->execute();
        if ($numDeleted > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePromotion($id) {

        $q = Doctrine_Query::create()
                        ->delete('Promotion')
                        ->where('prm_id=' . $id);

        $numDeleted = $q->execute();

        if ($numDeleted > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteReasoncklist($id) {

        $q = Doctrine_Query::create()
                        ->delete('PromotionCkecklist')
                        ->where('prm_checklist_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        } else {
            return false;
        }
    }

     public function getProbationlist($searchMode, $searchValue, $culture='en', $orderField = 'r.emp_number', $orderBy = 'ASC', $page = 1) {

        switch ($searchMode) {
            case "emp_name":
                if ($culture == 'en')
                    $feildName = "r.emp_display_name";
                else
                    $feildName="r.emp_display_name_" . $culture;
                break;
            case "app_letter":
                $feildName = "r.emp_app_letter_no";
                break;
            case "start_date":
                $feildName = "r.emp_prob_from_date";
                break;
            case "end_date":
                $feildName = "r.emp_prob_to_date";
                break;
        }
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('Employee r')
                        ->where("r.emp_status = ?",'EST007');

        if ($searchValue != "") {
            $q->Andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function searchOtherInstitution($searchMode, $searchValue, $culture='en', $orderField = 'o.oth_inst_id', $orderBy = 'ASC', $page = 1) {

        if ($searchMode == "emp_name") {
            if ($culture == "en")
                $feildName = "e.emp_display_name";
            else
                $feildName="e.emp_display_name_" . $culture;
        }else if ($searchMode == "emp_number") {
            $feildName = "e.employeeId";
        }else if ($searchMode == "institute") {
            $feildName = "o.oth_institute_name";
        }
        $q = Doctrine_Query::create()
                ->select('o.*')
                ->from('OtherInstitute o')
                ->leftJoin('o.Employee e');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function deleteReason($id) {

        $q = Doctrine_Query::create()
                        ->delete('PromotionMethod')
                        ->where('prm_method_id	=' . $id);

        $numDeleted = $q->execute();

        if ($numDeleted > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getPromotionckList($searchMode, $searchValue, $culture='en', $orderField = 'r.prm_checklist_id', $orderBy = 'ASC', $page = 1) {

        switch ($searchMode) {
            case "prm_checklist_name_":
                $feildName = "r.prm_checklist_name_" . $culture;
                break;
        }
        $q = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('PromotionCkecklist r');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);

        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function deleteOtherInstitution($id) {
        $q = Doctrine_Query::create()
                        ->delete('OtherInstitute o')
                        ->where('o.oth_inst_id = ?', $id);


        return $q->execute();
    }

    public function deleteAttach1($id) {

        $q = Doctrine_Query::create()
                        ->delete('PromotionCnfAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $q->execute();
    }

    public function getHistoryPromotion($searchMode, $searchValue, $culture='en', $orderField = 'p.prm_divition', $orderBy = 'ASC', $page = 1,$EmpNo, $EmpName) {


                if ($searchMode == "prm_effective_date") {
                $q = Doctrine_Query::create()
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number');
                                if($EmpNo){        
                        $q->where("p.emp_number IN (".$EmpNo.")");
                        }
                                $q->andwhere("p.prm_effective_date LIKE ?", '%' . trim($searchValue) . '%')
                                ->orderBy($orderField . ' ' . $orderBy);
            } else if ($searchMode == "prm_method_comment_") {
                $searchMode = "prm_method_comment_" . $culture;

                $q = Doctrine_Query::create()
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number');
                                if($EmpNo){        
                        $q->where("p.emp_number IN (".$EmpNo.")");
                        }
                                $q->andwhere("pm.prm_method_comment_" . $culture . " LIKE ?", '%' . trim($searchValue) . '%')
                                ->orderBy($orderField . ' ' . $orderBy);
            } else if ($searchMode == "empid") {
                $q = Doctrine_Query::create()
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number');
                                if($EmpNo){        
                        $q->where("p.emp_number IN (".$EmpNo.")");
                        }
                                $q->andwhere("p.emp_number = ?", $searchValue)
                                ->orderBy($orderField . ' ' . $orderBy);
            } else if ($searchMode == "emp_display_name_") {
                if($culture==en){
                    $fieild='e.emp_display_name';
                }else{
                    $fieild='e.emp_display_name_' . $culture;
                }

                $q = Doctrine_Query::create()
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number');
                                if($EmpNo){        
                        $q->where("p.emp_number IN (".$EmpNo.")");
                        }
                                $q->andwhere($fieild . " LIKE ?", '%' . trim($searchValue) . '%')
                                ->orderBy($orderField . ' ' . $orderBy);
            } else {
                $q = Doctrine_Query::create()
                                ->select('p.*')
                                ->from('Promotion p')
                                ->leftJoin('p.ServiceDetails s ON p.service_code = s.service_code')
                                ->leftJoin('p.JobTitle j ON p.jobtit_code = j.jobtit_code')
                                ->leftJoin('p.EmployeeStatus emp ON p.estat_code = emp.estat_code')
                                ->leftJoin('p.PromotionMethod pm ON p.prm_method_id = pm.prm_method_id')
                                ->innerJoin('p.Employee e ON p.emp_number = e.emp_number');
                        if($EmpNo){        
                        $q->where("p.emp_number IN (".$EmpNo.")");
                        }
                        $q->orderBy($orderField . ' ' . $orderBy);
            }
//die(print_r($q->getSql()));
            $sysConf = new sysConf();
            $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

            // Pager object
            $pagerLayout = new CommonhrmPager(
                            new Doctrine_Pager(
                                    $q,
                                    $page,
                                    $resultsPerPage
                            ),
                            new Doctrine_Pager_Range_Sliding(array(
                                'chunk' => 5
                            )),
                            "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}&empno={$EmpNo}&empname={$EmpName}"
            );

            $pager = $pagerLayout->getPager();
            $res = array();
            $res['data'] = $pager->execute();
            $res['pglay'] = $pagerLayout;

            return $res;

    }
    
    public function getJoinedDate($id) {
        return Doctrine::getTable('Employee')->find($id);
    }
    
        public function getLastEffectiveDate($id) {
        $q = Doctrine_Query::create()
                ->select('MAX(prm_effective_date)')
                ->from('Promotion r')
                ->where('r.emp_number = ?', $id);
        return $q->fetchArray();
    }
    
    public function getEBExam($empid,$serviceId,$gradeId) {
        $q = Doctrine_Query::create()
                ->select('e.*,x.*')
                ->from('EMPEBExam e')
                ->leftJoin('e.EBExam x ON x.ebexam_id = e.ebexam_id')
                ->where('e.employee_id = ?', $empid)
                ->Andwhere('e.emp_ebexam_status = 1')
                ->Andwhere('x.service_code = ?',$serviceId)
                ->Andwhere('x.grade_code = ?',$gradeId);

        return $q->fetchArray();
    }

}

?>
