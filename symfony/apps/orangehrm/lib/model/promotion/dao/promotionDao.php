<?php

/**
 * Actions class for Promotion Module
 *
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 18 oct 2011
 *  Comments  - Employee Promotion Functions
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class promotionDao extends BaseDao {

    public function getDepartment($id) {
        try {
            return Doctrine::getTable('CompanyStructure')->find($id);
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }


public function updateEmpMaster($varibleList) {
                        
                        $query = Doctrine_Query::create()
                        ->update('Employee e');
                         if($varibleList['desg']!= null){
                        $query->set('e.job_title_code', '?', $varibleList['desg']);
                         }
                         if($varibleList['esta']!= null){
                        $query->set('e.emp_status', '?', $varibleList['esta']);
                         }
                         if($varibleList['Level']!= null){
                        $query->set('e.level_code', '?', $varibleList['Level']);
                         }
                         if($varibleList['service']!= null){
                        $query->set('e.service_code', '?', $varibleList['service']);
                         }
                         if($varibleList['class']!= null){
                        $query->set('e.class_code', '?',$varibleList['class']);
                         }
                         if($varibleList['grade']!= null){
                        $query->set('e.grade_code', '?', $varibleList['grade']);
                         }
                         if($varibleList['gradeslot']!= null){
                        $query->set('e.slt_scale_year', '?', $varibleList['gradeslot']);
                         }
                         if($varibleList['incrementdate']!= null){
                        $query->set('e.emp_salary_inc_date', '?', $varibleList['incrementdate']);
                         }
                         if($varibleList['worksatation']!= null){
                        $query->set('e.work_station', '?', $varibleList['worksatation']);
                         }
                         
                        $query->where('e.emp_number = ?', $varibleList['id']);
                        
        return $query->execute();
        
    }
   
    public function savePromotionMethod(PromotionMethod $prmmethod) {
        $prmmethod->save();
        return true;
    }

    public function savePromotioncklist(PromotionCkecklist $PromotionCkecklist,$request) {
        if (strlen($request->getParameter('txtName'))) {
                    $PromotionCkecklist->setPrm_checklist_name_en(trim($request->getParameter('txtName')));
                } else {
                    $PromotionCkecklist->setPrm_checklist_name_en(null);
                }
                if (strlen($request->getParameter('txtNamesi'))) {
                    $PromotionCkecklist->setPrm_checklist_name_si(trim($request->getParameter('txtNamesi')));
                } else {
                    $PromotionCkecklist->setPrm_checklist_name_si(null);
                }
                if (strlen($request->getParameter('txtNameta'))) {
                    $PromotionCkecklist->setPrm_checklist_name_ta(trim($request->getParameter('txtNameta')));
                } else {
                    $PromotionCkecklist->setPrm_checklist_name_ta(null);
                }

        $PromotionCkecklist->save();
        return true;
    }

    public function saveNewPromotion(Promotion $promotion) {
        $promotion->save();
        return true;
    }

    

    public function savePromotioncnfmethod(PromotionConfirmMethod $promotion) {
        $promotion->save();
        return true;
    }

    public function getLastID() {
        $query = Doctrine_Query::create()
                        ->select('MAX(prm_method_id)')
                        ->from('PromotionMethod r');
        return $query->fetchArray();
    }

    public function getLastckID() {
        $query = Doctrine_Query::create()
                        ->select('MAX(prm_checklist_id)')
                        ->from('hs_hr_promotion_ckecklist r');
        return $query->fetchArray();
    }

    public function readPromotionMethod($id) {
        return Doctrine::getTable('PromotionMethod')->find($id);
    }

    public function readPromotionconfirmMethod($id) {
        return Doctrine::getTable('PromotionConfirmMethod')->find($id);
    }

    public function readPromotionMethodd() {

        return Doctrine::getTable('PromotionMethod');
    }

    public function readPromotioncklist($id) {

        return Doctrine::getTable('PromotionCkecklist')->find($id);
    }

    public function readPromotion($id) {

        return Doctrine::getTable('Promotion')->find($id);
    }

    public function readEmployee($id) {

        return Doctrine::getTable('Employee')->find($id);


    }

 
    public function getEmployeerecord($id) {

        $query = Doctrine_Query::create()
                        ->from('Employee em')
                        ->where('em.emp_number = ?', $id);

        $list = $query->fetchArray();
        return $list;
    }

    public function getPrmfrmLoadGrd() {


        $query = Doctrine_Query::create()
                        ->from('Grade');

        return $query->execute();

        
    }

    public function getPrmfrmLoadDesc() {

        $query = Doctrine_Query::create()
                        ->from('JobTitle');
        return $query->execute();

        
    }

    public function getPrmfrmLoadEType() {


        $query = Doctrine_Query::create()
                        ->from('EmployeeStatus');
        return $query->execute();

        
    }

    public function getPrmfrmLoadsvc() {


        $query = Doctrine_Query::create()
                        ->from('ServiceDetails');

        return $query->execute();

        
    }

    public function getPrmfrmLoadPMsevice() {


        $query = Doctrine_Query::create()
                        ->from('ServiceDetails');
        return $query->execute();

       
    }

    public function getPrmfrmLoadPMethod() {

        $query = Doctrine_Query::create()
                        ->from('PromotionMethod');
        return $query->execute();

        
    }

    public function getPrmfrmLoadPConfMethod() {

        $query = Doctrine_Query::create()
                        ->from('PromotionConfirmMethod');
        return $query->execute();
    }

    public function getPrmfrmLoadDev() {

        $query = Doctrine_Query::create()
                        ->from('CompanyStructure');
        return $query->execute();

        
    }

    public function ajaxData($id) {

        $query = Doctrine_Query::create()
                        ->from('Employee e')
                        ->where("emp_number = ?", $id);

        return $query->fetchArray();
    }

    public function getPckList() {
        $query= Doctrine_Query::create()
                        ->select('r.*')
                        ->from('PromotionCkecklist r');
        return $query->fetchArray();
    }


    public function getPromotionckListmax() {
        $query= Doctrine_Query::create()
                        ->select('count(r.prm_checklist_id)')
                        ->from('PromotionCkecklist r');
        return $query->fetchArray();
    }

    public function savePromotioncklistdetails(PromotionChecklistDetail $promotion) {
        $promotion->save();
        return true;
    }

    public function savecklistdetails(PromotionChecklistDetail $ChecklistDetail) {
        $ChecklistDetail->save();
        return true;
    }

    public function getLastPromotionID() {
        $query = Doctrine_Query::create()
                        ->select('MAX(r.prm_id)')
                        ->from('Promotion r');
        return $query->fetchArray();
    }

    public function updatch($id) {

        $query = Doctrine_Query::create()
                        ->delete('PromotionAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $query->execute();
    }

    public function updcatch($id) {

        $query = Doctrine_Query::create()
                        ->delete('PromotionCnfAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $query->execute();
    }
   
    public function saveNewAttachment(PromotionAttachment $prmattach) {
        $prmattach->save();

        return true;
    }

    public function saveNewCAttachment(PromotionCnfAttachment $prmattach) {

        $prmattach->save();

        return true;
    }

    public function getAttachdetails($id) {

        $query = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('PromotionAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $query->fetchArray();
    }

    public function getaAttachdetails($id) {

        $query = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('PromotionAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $query->execute();
    }

    public function gettAttachdetails() {

        $query = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('PromotionAttachment t');


        return $query->execute();
    }

    public function getAttachdetails1($id) {

        $query = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('PromotionCnfAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $query->fetchArray();
    }

    public function readaatt($id) {

        return Doctrine::getTable('PromotionAttachment')->find(array($id, $id));
    }


    public function readattach($id) {
       $query = Doctrine_Query::create()
                        ->select('count(t.prm_id)')
                        ->from('PromotionAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $query->fetchArray();
    }

    public function readattach1($id) {
        $query = Doctrine_Query::create()
                        ->select('count(t.prm_id)')
                        ->from('PromotionCnfAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $query->fetchArray();
    }

    public function readcattach($id) {
        $query = Doctrine_Query::create()
                        ->select('count(t.prm_id)')
                        ->from('PromotionCnfAttachment t')
                        ->where('t.prm_id = ?', $id);

        return $query->fetchArray();
    }

   

    public function ckdel($id, $cid) {
        $query= Doctrine_Query::create()
                        ->delete('PromotionChecklistDetail r')
                        ->where('r.emp_number = ?', $id)
                        ->andwhere('r.prm_checklist_id = ?', $cid);

        return $query->execute();
    }

    public function delchecklistdetails($id) {
        $query = Doctrine_Query::create()
                        ->delete('PromotionChecklistDetail r')
                        ->where('r.prm_id = ?', $id);


        return $query->execute();
    }

    public function prmdetails($id) {
        $query = Doctrine_Query::create()
                        ->select('t.prm_checklist_id')
                        ->from('PromotionChecklistDetail t')
                        ->where('t.prm_id = ?', $id);
        return $query->fetchArray();
    }

    public function cklistetails($id) {
        $query = Doctrine_Query::create()
                        //->select('t.prm_checklist_id,t.prm_complete_date')
                        ->select('t.*')
                        ->from('PromotionChecklistDetail t')
                        ->where('t.emp_number = ?', $id);
        return $query->fetchArray();
    }

    public function cklistetailsDate($id) {
        $query = Doctrine_Query::create()
                        ->select('t.prm_complete_date')
                        ->from('PromotionChecklistDetail t')
                        ->where('t.emp_number = ?', $id);
        return $query->fetchArray();
    }
    
        public function getClassLoad() {

        $query = Doctrine_Query::create()
                        ->from('EmpClass');
        return $query->execute();

        
    }
    
            public function getGradeLoad() {

        $query = Doctrine_Query::create()
                        ->from('Grade');
        return $query->execute();

        
    }
    
      public function getLevelLoad() {

        $query = Doctrine_Query::create()
                        ->from('Level');
        return $query->execute();

        
    }
    
            public function getGradeSlotLoadID($yr,$grade) {

       $query = Doctrine_Query::create()
                        ->select('g.*')
                        ->from('GradeSlot g')
                        ->where('g.slt_scale_year =?',$yr)
                        ->Andwhere('g.grade_code =?',$grade);
        return $query->fetchone();

        
    }
    
    public function getGradeSlotByID($id) {
        $query = Doctrine_Query::create()
                        ->select('g.*')
                        ->from('GradeSlot g')
                        ->where('g.grade_code = ?', $id);
        return $query->execute();

    }
    
     public function getEmployee($id) {

        $query = Doctrine_Query::create()
                        ->from('Employee e')
                        ->where('e.emp_number = ?', $id);

         
        return $query->fetchone();
    }
    
     public function PromotionCkeckComment($id) {

        $query = Doctrine_Query::create()
                        ->select('t.prm_comment')
                        ->from('PromotionChecklistDetail t')
                        ->where('t.emp_number = ?', $id);
        return $query->fetchArray();
    }
    
     
    
    public function readOtherInstitution($id) {

        return Doctrine::getTable('OtherInstitute')->find($id);
    }
    
    public function saveOtherInstitution(OtherInstitute $OtherInstitute) {

        $OtherInstitute->save();
        return true;
    }
    
    public function saveEmployee(Employee $Employee) {

        $Employee->save();
        return true;
    }
    
   public function readCompanyStructure($id)
   {

         $query = Doctrine_Query::create()
            ->from('CompanyStructure cs')
            ->where("id = ?", $id);
         if($query->count() == 0) {
            return false;
         }
         return $query->fetchOne();

   }
   
    public function readDeflevelById($id){
             
            return Doctrine::getTable('EmployeeDefLevel')->find($id);

    }
    
    public function getGradeSlot($id){
             
               $query = Doctrine_Query::create()
             ->select('g.*')          
            ->from('GradeSlot g')
            ->where("g.slt_id = ?", $id);
               return $query->fetchOne();
    }
    
    public function getPendingUpadatePromotions(){
        $e = getdate();
        $today = date("Y-m-d", $e[0]);
        
               $query = Doctrine_Query::create()
                ->select('p.*')          
                ->from('Promotion p')
                ->where("p.prm_effective_date = ?", $today);
               return $query->execute();
    }
    
    
     public function getPromotionServiceObj($PromotionMethod,$request) {
             if (strlen($request->getParameter('txtName'))) {
                    $PromotionMethod->setPrm_method_comment_en(trim($request->getParameter('txtName')));
                } else {
                    $PromotionMethod->setPrm_method_comment_en(null);
                }
                if (strlen($request->getParameter('txtNamesi'))) {
                    $PromotionMethod->setPrm_method_comment_si(trim($request->getParameter('txtNamesi')));
                } else {
                    $PromotionMethod->setPrm_method_comment_si(null);
                }
                if (strlen($request->getParameter('txtNameta'))) {
                    $PromotionMethod->setPrm_method_comment_ta(trim($request->getParameter('txtNameta')));
                } else {
                    $PromotionMethod->setPrm_method_comment_ta(null);
                }

                return $PromotionMethod;

     }
     
     public function getPromortionChecklistByID($id,$PrmPid) {
        $query = Doctrine_Query::create()
                        ->select('r.*')
                        ->from('PromotionChecklistDetail r')
                        ->where("r.prm_checklist_id = ?",$id)
                        ->Andwhere("r.emp_number = ?",$PrmPid);
        return $query->fetchOne();
    }

}

