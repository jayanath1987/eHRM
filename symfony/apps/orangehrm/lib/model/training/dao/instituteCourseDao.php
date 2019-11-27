<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 17 June 2011
 *  Comments  - Employee Training
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class InstituteCourseDao extends BaseDao {
    
    

   public function saveTransIns(TrainingInstitute $transIns) {
        return $transIns->save();
    }
    
     public function getLastInstituteID() {
        $q = Doctrine_Query::create()
                        ->select('MAX(td_inst_id)')
                        ->from('TrainingInstitute');
        return $q->fetchArray();
    }
     public function readTrainIns($id) {

            return Doctrine::getTable('TrainingInstitute')->find($id);

    }

    public function getInstitutelist() {

        $q = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('TrainingInstitute t');
        return $q->execute();
    }
     public function getmedium() {
        $q = Doctrine_Query::create()
                        ->select('l.*')
                        ->from('Language l');
        return $q->execute();
    }
    
    public function getLevelCombo() {
        $q = Doctrine_Query::create()
                        ->select('l.*')
                        ->from('Level l');

        return $q->execute();
    }
    
    public function saveCourse($request) {

                $trainingcourse = new TrainingCourse();

                $timefromHR = $request->getParameter('timefromHR');
                $timefromMM = $request->getParameter('timefromMM');
                $timetoHR = $request->getParameter('timetoHR');
                $timetoMM = $request->getParameter('timetoMM');
                if(($timefromHR==null && $timefromMM==null) && ($timetoHR==null && $timetoMM==null)){
                    $fromtime=null;
                    $totime=null;

                }else{
                  if ($timefromHR != -1 && $timefromMM != -1) {
                    $fromtime = $timefromHR . ":" . $timefromMM;
                } elseif ($timefromHR != -1 && $timefromMM == -1) {
                    $fromtime = $timefromHR . ":00";
                } elseif ($timefromHR == -1 && $timefromMM != -1) {
                    $fromtime = "00:" . $timefromMM;
                } else {
                    $fromtime = "";
                }

                if ($timetoHR != -1 && $timetoMM != -1) {
                    $totime = $timetoHR . ":" . $timetoMM;
                } elseif ($timetoHR == -1 && $timetoMM != -1) {
                    $totime = "00:" . $timetoMM;
                } elseif ($timetoHR != -1 && $timetoMM == -1) {
                    $totime = $timetoHR . ":00";
                } else {
                    $totime = "";
                }
                }
                $trainingcourse->setTd_inst_id($request->getParameter('instiName'));
                $trainingcourse->setTd_course_year((int) $request->getParameter('TrainYear'));
                $trainingcourse->setTd_course_code($request->getParameter('TrainCode'));

                if (strlen($request->getParameter('TrainNameEn'))) {
                    $trainingcourse->setTd_course_name_en(trim($request->getParameter('TrainNameEn')));
                } else {
                    $trainingcourse->setTd_course_name_en(null);
                }
                if (strlen($request->getParameter('TrainNameSi'))) {
                    $trainingcourse->setTd_course_name_si(trim($request->getParameter('TrainNameSi')));
                } else {
                    $trainingcourse->setTd_course_name_si(null);
                }
                if (strlen($request->getParameter('TrainNameTa'))) {
                    $trainingcourse->setTd_course_name_ta(trim($request->getParameter('TrainNameTa')));
                } else {
                    $trainingcourse->setTd_course_name_ta(null);
                }


                if (strlen($request->getParameter('medium'))) {
                    $trainingcourse->setLang_code($request->getParameter('medium'));
                } else {
                    $trainingcourse->setLang_code(null);
                }
                $trainingcourse->setTd_course_venue_en($request->getParameter('venueEn'));
                $trainingcourse->setTd_course_venue_si($request->getParameter('venueSi'));
                $trainingcourse->setTd_course_venue_ta($request->getParameter('venueTa'));
                if ($request->getParameter('fromdate') != null) {
                    $trainingcourse->setTd_course_fromdate(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('fromdate')));
                } else {
                    $trainingcourse->setTd_course_fromdate(null);
                }
                if ($request->getParameter('todate') != null) {
                    $trainingcourse->setTd_course_todate(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('todate')));
                } else {
                    $trainingcourse->setTd_course_todate(null);
                }
                $trainingcourse->setTd_course_fromtime($fromtime);
                $trainingcourse->setTd_course_totime($totime);
                $trainingcourse->setTd_course_objective_en($request->getParameter('ObjectiveEn'));
                $trainingcourse->setTd_course_objective_si($request->getParameter('ObjectiveSi'));
                $trainingcourse->setTd_course_objective_ta($request->getParameter('ObjectiveTa'));
                $trainingcourse->setTd_course_whom_en($request->getParameter('ForwhomEn'));
                $trainingcourse->setTd_course_whom_si($request->getParameter('ForwhomSi'));
                $trainingcourse->setTd_course_whom_ta($request->getParameter('ForwhomTa'));
                $trainingcourse->setTd_course_content_en($request->getParameter('ContentEn'));
                $trainingcourse->setTd_course_content_si($request->getParameter('ContentSi'));
                $trainingcourse->setTd_course_content_ta($request->getParameter('ContentTa'));
                $trainingcourse->setTd_course_fees($request->getParameter('fees'));

                if (strlen($request->getParameter('cmbLevel'))) {
                    $trainingcourse->setLevel_code(trim($request->getParameter('cmbLevel')));
                } else {
                    $trainingcourse->setLevel_code(null);
                }
                if (strlen($request->getParameter('feesPerHeadCost'))) {
                    $trainingcourse->setTd_course_fees_per_head(trim($request->getParameter('feesPerHeadCost')));
                } else {
                    $trainingcourse->setTd_course_fees_per_head(null);
                }
                if (strlen($request->getParameter('textAdditionalCost'))) {
                    $trainingcourse->setTd_course_fees_additional(trim($request->getParameter('textAdditionalCost')));
                } else {
                    $trainingcourse->setTd_course_fees_additional(null);
                }

                if (strlen($request->getParameter('txtRSP'))) {
                    $trainingcourse->setTd_course_resouse_person(trim($request->getParameter('txtRSP')));
                } else {
                    $trainingcourse->setTd_course_resouse_person(null);
                }
                if (strlen($request->getParameter('routeflow'))) {
                    $trainingcourse->setTd_approval_type(trim($request->getParameter('routeflow')));
                } else {
                    $trainingcourse->setTd_approval_type(null);
                }
        
        return $trainingcourse->save();;
    }
    
    public function getLastCourseID() {
        $q = Doctrine_Query::create()
                        ->select('MAX(r.td_course_id)')
                        ->from('TrainingCourse r');
        return $q->fetchArray();
    }
    
    public function readCourse($id) {
            return Doctrine::getTable('TrainingCourse')->find($id);
    }
   
    public function LoadCourse($id) {
        return Doctrine::getTable('TrainingCourse')->find($id);
    }
    public function getCountofTrainCode($courseId) {

        $q = Doctrine_Query::create()
                        ->select('COUNT(t.td_course_code)')
                        ->from('TrainingCourse t')
                        ->where('td_course_code= ?', array($courseId));

        return $q->fetchArray();
    }
    
    public function getCountofTrainCodeUpdate($courseId, $currentCode) {

        $q = Doctrine_Query::create()
                        ->select('COUNT(t.td_course_code)')
                        ->from('TrainingCourse t')
                        ->where('td_course_code= ?', array($courseId))
                        ->andwhere('td_course_code != ?', array($currentCode));


        return $q->fetchArray();
    }
     public function readTrainRecords($empId,$courseID){

        try {
            return Doctrine::getTable('TrainAssign')->find(array($empId,$courseID));
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }

    }
    public function isrecored($courseId, $empId) {

        $q = Doctrine_Query::create()
                        ->select('count(a.emp_number)')
                        ->from('TrainAssign a')
                        ->where('a.td_course_id = ?', $courseId)
                        ->andWhere('a.emp_number = ?', $empId)
                        ->andwhere('a.td_asl_isempfb = ?', 1);

        return $q->fetchArray();
    }
     public function getTrainRecordListUpdate($empid, $cid) {
        $q = Doctrine_Query::create()
                        ->select('t.*,')
                        ->from('TrainAssign t')
                        ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                        ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                        ->leftJoin('t.Employee e ON t.emp_number = e.emp_number')
                        ->where('t.td_asl_content !="" ')
                        ->andwhere('e.emp_number =' . $empid)
                        ->andwhere('t.td_course_id =' . $cid);

        return $q->fetchArray();
    }
     public function getTrainRecordList($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC', $userType) {

            $empnum = $_SESSION['empNumber'];

            switch ($searchMode) {

                case "ename":
                    if ($culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name_" . $culture;
                    break;
                case "institute":
                    if ($culture == "en")
                        $feildName = "i.td_inst_name_en";
                    else
                        $feildName="i.td_inst_name_" . $culture;
                    break;
                case "course":
                    if ($culture == "en")
                        $feildName = "c.td_course_name_en";
                    else
                        $feildName="c.td_course_name_" . $culture;
                    break;
                case "year":

                    $feildName = "t.td_asl_year";

                    break;
            }
            $q = Doctrine_Query::create()
                            ->select('t.*')
                            ->from('TrainAssign t')
                            ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                            ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                            ->innerJoin('t.Employee e ON t.emp_number = e.emp_number')
                            ->where('t.td_asl_isempfb ="1"');
            if ($userType == "Ess") {
                $q->andwhere('e.emp_number =' . $empnum);
            }
            if ($searchValue != "") {
                $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
            }
            $q->orderBy($orderField . ' ' . $orderBy);

            // Number of records for a one page
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
     public function getTrainRecordListAdmin($searchMode, $searchValue, $culture="", $page=1, $orderField='t.td_course_id', $orderBy='ASC') {

            $empnum = $_SESSION['empNumber'];

            switch ($searchMode) {

                case "ename":
                    if ($culture == "en")
                        $feildName = "e.emp_display_name";
                    else
                        $feildName="e.emp_display_name_" . $culture;
                    break;
                case "institute":
                    if ($culture == "en")
                        $feildName = "i.td_inst_name_en";
                    else
                        $feildName="i.td_inst_name_" . $culture;
                    break;
                case "course":
                    if ($culture == "en")
                        $feildName = "c.td_course_name_en";
                    else
                        $feildName="c.td_course_name_" . $culture;
                    break;
                case "year":

                    $feildName = "t.td_asl_year";

                    break;
            }
            $q = Doctrine_Query::create()
                            ->select('t.*')
                            ->from('TrainAssign t')
                            ->leftJoin('t.TrainingCourse c ON t.td_course_id = c.td_course_id')
                            ->leftJoin('c.TrainingInstitute i ON c.td_inst_id = i.td_inst_id')
                            ->innerJoin('t.Employee e ON t.emp_number = e.emp_number')
                            ->where('t.td_asl_isempfb ="1"');

            if ($searchValue != "") {
                $q->andwhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
            }
            $q->orderBy($orderField . ' ' . $orderBy);

            // Number of records for a one page
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
    public function getInstituteName($id) {

            return Doctrine::getTable('TrainingCourse')->find($id);

        return $q->execute();
    }

    public function getCoursename($id) {

            return Doctrine::getTable('TrainingCourse')->find($id);

        return $q->execute();
    }
    public function readWFRecord($id) {

        $q = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('TrainAssign t')
                        ->where('t.wfmain_id=' . $id);

        return $q->fetchOne();
    }
    public function updateCourse($obj){
       return  $obj->save();
    }

    public function courseDuration($courseId){


        $courseDetails=Doctrine::getTable('TrainingCourse')->find($courseId);
        $startDate = new DateTime($courseDetails->td_course_fromdate);
        $endDate = new DateTime($courseDetails->td_course_todate);
        $diff = $startDate->diff($endDate);

        $startTime = new DateTime($courseDetails->td_course_fromtime);
        $Totime = new DateTime($courseDetails->td_course_totime);
        $diffTime = $startTime->diff($Totime);

        $years = $diff->format('%y');
        $months = $diff->format('%m');
        $days = $diff->format('%d');
        $hours=$diffTime->format('%h');
        $minutes=$diffTime->format('%i');




        return $years."-".$months."-".$days."-".$hours."-".$minutes;
    }

    public function getConductDate($courseId){
        $courseDetails=Doctrine::getTable('TrainingCourse')->find($courseId);
        return $courseDetails->td_course_fromdate;
    }

    public function getTrainingStatus($courseId, $empId){
        $courseDetails=Doctrine::getTable('TrainAssign')->find(array($empId,$courseId));
        return $courseDetails->td_asl_isapproved;
    }

    public function updateCourceObject($request,$tcourse){
            $timefromHR = $request->getParameter('timefromHR');
                $timefromMM = $request->getParameter('timefromMM');
                $timetoHR = $request->getParameter('timetoHR');
                $timetoMM = $request->getParameter('timetoMM');

                if ($timefromHR != -1 && $timefromMM != -1) {
                    $fromtime = $timefromHR . ":" . $timefromMM;
                } elseif ($timefromHR != -1 && $timefromMM == -1) {
                    $fromtime = $timefromHR . ":00";
                } elseif ($timefromHR == -1 && $timefromMM != -1) {
                    $fromtime = "00:" . $timefromMM;
                } else {
                    $fromtime = "";
                }

                if ($timetoHR != -1 && $timetoMM != -1) {
                    $totime = $timetoHR . ":" . $timetoMM;
                } elseif ($timetoHR == -1 && $timetoMM != -1) {
                    $totime = "00:" . $timetoMM;
                } elseif ($timetoHR != -1 && $timetoMM == -1) {
                    $totime = $timetoHR . ":00";
                } else {
                    $totime = "";
                }

                $tcourse->setTd_inst_id($request->getParameter('instiName'));
                $tcourse->setTd_course_year($request->getParameter('TrainYear'));
                $tcourse->setTd_course_code($request->getParameter('TrainCode'));

                if (strlen($request->getParameter('TrainNameEn'))) {
                    $tcourse->setTd_course_name_en(trim($request->getParameter('TrainNameEn')));
                } else {
                    $tcourse->setTd_course_name_en(null);
                }
                if (strlen($request->getParameter('TrainNameSi'))) {
                    $tcourse->setTd_course_name_si(trim($request->getParameter('TrainNameSi')));
                } else {
                    $tcourse->setTd_course_name_si(null);
                }
                if (strlen($request->getParameter('TrainNameTa'))) {
                    $tcourse->setTd_course_name_ta(trim($request->getParameter('TrainNameTa')));
                } else {
                    $tcourse->setTd_course_name_ta(null);
                }

                if (strlen($request->getParameter('medium'))) {
                    $tcourse->setLang_code($request->getParameter('medium'));
                } else {
                    $tcourse->setLang_code(null);
                }
                $tcourse->setTd_course_venue_en($request->getParameter('venueEn'));
                $tcourse->setTd_course_venue_si($request->getParameter('venueSi'));
                $tcourse->setTd_course_venue_ta($request->getParameter('venueTa'));
                if ($request->getParameter('fromdate') != null) {
                    $tcourse->setTd_course_fromdate(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('fromdate')));
                } else {
                    $tcourse->setTd_course_fromdate(null);
                }
                if ($request->getParameter('todate') != null) {
                    $tcourse->setTd_course_todate(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('todate')));
                } else {
                    $tcourse->setTd_course_todate(null);
                }
                $tcourse->setTd_course_fromtime($fromtime);
                $tcourse->setTd_course_totime($totime);
                $tcourse->setTd_course_objective_en($request->getParameter('ObjectiveEn'));
                $tcourse->setTd_course_objective_si($request->getParameter('ObjectiveSi'));
                $tcourse->setTd_course_objective_ta($request->getParameter('ObjectiveTa'));
                $tcourse->setTd_course_whom_en($request->getParameter('ForwhomEn'));
                $tcourse->setTd_course_whom_si($request->getParameter('ForwhomSi'));
                $tcourse->setTd_course_whom_ta($request->getParameter('ForwhomTa'));
                $tcourse->setTd_course_content_en($request->getParameter('ContentEn'));
                $tcourse->setTd_course_content_si($request->getParameter('ContentSi'));
                $tcourse->setTd_course_content_ta($request->getParameter('ContentTa'));
                $tcourse->setTd_course_fees($request->getParameter('fees'));
                

                if (strlen($request->getParameter('cmbLevel'))) {
                    $tcourse->setLevel_code(trim($request->getParameter('cmbLevel')));
                } else {
                    $tcourse->setLevel_code(null);
                }
                if (strlen($request->getParameter('feesPerHeadCost'))) {
                    $tcourse->setTd_course_fees_per_head(trim($request->getParameter('feesPerHeadCost')));
                } else {
                    $tcourse->setTd_course_fees_per_head(null);
                }
                if (strlen($request->getParameter('textAdditionalCost'))) {
                    $tcourse->setTd_course_fees_additional(trim($request->getParameter('textAdditionalCost')));
                } else {
                    $tcourse->setTd_course_fees_additional(null);
                }
                if (strlen($request->getParameter('txtRSP'))) {
                    $tcourse->setTd_course_resouse_person(trim($request->getParameter('txtRSP')));
                } else {
                    $tcourse->setTd_course_resouse_person(null);
                }
                if (strlen($request->getParameter('routeflow'))) {
                     $tcourse->setTd_approval_type($request->getParameter('routeflow'));
                } else {
                     $tcourse->setTd_approval_type();
                }
                
               
                return $tcourse;



    }

    public function readEmployeeSupervisor($id) {
                    $q = Doctrine_Query::create()
                ->select("rt.*")
                ->from('ReportTo rt')
                ->where("rt.subordinateId=$id");
                    
                    return $q->fetchOne();
    }
    
        public function readTrainingApprovalInDesignationWise($id) {
                    $q = Doctrine_Query::create()
                ->select("e.*")
                ->from("Employee e")
                ->where("e.job_title_code = '$id'");
                    
                    return $q->fetchOne();
    }

}


?>
