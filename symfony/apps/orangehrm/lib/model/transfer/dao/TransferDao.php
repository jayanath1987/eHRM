<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Transfer Module Transfer Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
require_once '../../lib/common/LocaleUtil.php';

class TransferDao extends BaseDao {

    public $headOfficeIds=array();
    /**
     * Executes updateEmpMaster function 
     * 
     * @param Employee $emp
     * @return type 
     */
    public function saveTransferRequestSub($request){
          if (strlen($request->getParameter('txtTransferReasonCode'))) {
                    $transRequest = $transferService->readTransferReasonbyId($request->getParameter('txtTransferReasonCode'));
                } else {
                    $transRequest = new TransferRequest();
                }
                if ($_SESSION['empNumber'] != null) {
                    $transRequest->setEmp_number($_SESSION['empNumber']);
                } else {
                    $transRequest->setEmp_number(null);
                }

                if (strlen($request->getParameter('cmbLevel'))) {
                    $transRequest->setDef_level((int) $request->getParameter('cmbLevel'));
                } else {
                    $transRequest->setDef_level(null);
                }

                if (strlen($request->getParameter('cmbhDep'))) {

                        $transRequest->setId($request->getParameter('cmbhDep'));

                }
                else if (strlen($request->getParameter('cmdLevel2'))) {
                    if ($request->getParameter('cmdLevel2') == $Headoffice) {
                        $transRequest->setId($request->getParameter('cmdLevel3'));
                    } else {
                        $transRequest->setId($request->getParameter('cmdLevel2'));
                    }
                }
                else {
                    $transRequest->setId(null);
                }

                if (strlen($request->getParameter('prf1'))) {
                    $transRequest->setTrans_req_location_pref1($request->getParameter('prf1'));
                } else {
                    $transRequest->setTrans_req_location_pref1(null);
                }
                if (strlen($request->getParameter('prf2'))) {
                    $transRequest->setTrans_req_location_pref2($request->getParameter('prf2'));
                } else {
                    $transRequest->setTrans_req_location_pref2(null);
                }
                if (strlen($request->getParameter('prf3'))) {
                    $transRequest->setTrans_req_location_pref3($request->getParameter('prf3'));
                } else {
                    $transRequest->setTrans_req_location_pref3(null);
                }
                if (strlen($request->getParameter('comment'))) {
                    $transRequest->setTrans_req_usercommnet($request->getParameter('comment'));
                } else {
                    $transRequest->setTrans_req_usercommnet(null);
                }
                if (strlen($request->getParameter('admincomment'))) {
                    $transRequest->setTrans_req_admincommnet($request->getParameter('admincomment'));
                } else {
                    $transRequest->setTrans_req_admincommnet(null);
                }

                return $transRequest;
    }

    public function saveAdminRequestSub($request){

        if (strlen($request->getParameter('txtTransferReasonCode'))) {
                    $transRequest = $transferService->readTransferReasonbyId($request->getParameter('txtTransferReasonCode'));
                } else {
                    $transRequest = new TransferRequest();
                }
                if (strlen($request->getParameter('txtEmpId'))) {
                    $transRequest->setEmp_number($request->getParameter('txtEmpId'));
                } else {
                    $transRequest->setEmp_number(null);
                }

                if (strlen($request->getParameter('cmbLevel'))) {
                    $transRequest->setDef_level((int) $request->getParameter('cmbLevel'));
                } else {
                    $transRequest->setDef_level(null);
                }

                 if (strlen($request->getParameter('cmbhDep'))) {

                        $transRequest->setId($request->getParameter('cmbhDep'));

                }
                else if (strlen($request->getParameter('cmdLevel2'))) {
                    if ($request->getParameter('cmdLevel2') == $Headoffice) {
                        $transRequest->setId($request->getParameter('cmdLevel3'));
                    } else {
                        $transRequest->setId($request->getParameter('cmdLevel2'));
                    }
                }
                else {
                    $transRequest->setId(null);
                }
                if (strlen($request->getParameter('prf1'))) {
                    $transRequest->setTrans_req_location_pref1($request->getParameter('prf1'));
                } else {
                    $transRequest->setTrans_req_location_pref1(null);
                }
                if (strlen($request->getParameter('prf2'))) {
                    $transRequest->setTrans_req_location_pref2($request->getParameter('prf2'));
                } else {
                    $transRequest->setTrans_req_location_pref2(null);
                }
                if (strlen($request->getParameter('prf3'))) {
                    $transRequest->setTrans_req_location_pref3($request->getParameter('prf3'));
                } else {
                    $transRequest->setTrans_req_location_pref3(null);
                }
                if (strlen($request->getParameter('comment'))) {
                    $transRequest->setTrans_req_usercommnet($request->getParameter('comment'));
                } else {
                    $transRequest->setTrans_req_usercommnet(null);
                }
                if (strlen($request->getParameter('admincomment'))) {
                    $transRequest->setTrans_req_admincommnet($request->getParameter('admincomment'));
                } else {
                    $transRequest->setTrans_req_admincommnet(null);
                }
                return $transRequest;
    }

    public function updateEmpMaster(Employee $emp) {
        $emp->save();
        $q = Doctrine_Query::create()
                ->update('Employee e')
                ->set('e.work_station = ?', $wrkid)
                ->where('e.emp_number = ?', $id);
        return true;
    }

    /**
     *
     * Executes saveTransReason function 
     * 
     * @param TransferReason $trans
     * @return type 
     */
    public function saveTransReason(TransferReason $trans) {
        $trans->save();
        return true;
    }

    /**
     *
     * Executes save NewTransfer function 
     * 
     * @param Transfer $trans
     * @return type 
     */
    public function saveNewTransfer(Transfer $trans) {
        $trans->save();
        return true;
    }

    /**
     *
     * Executes save NewAttachment function
     * 
     * @param TransferAttach $transattach
     * @return type 
     */
    public function saveNewAttachment(TransferAttach $transattach) {
        $transattach->save();
        return true;
    }

    /**
     * 
     * Executes save get TransferReason LastID  function
     * 
     * @return type 
     */
    public function getLastID() {
        $q = Doctrine_Query::create()
                ->select('MAX(trans_reason_id)')
                ->from('TransferReason r');
        return $q->fetchArray();
    }

    /**
     * Executes save getLastTransferID  function
     * 
     * @return type 
     */
    public function getLastTransferID() {
        $q = Doctrine_Query::create()
                ->select('MAX(trans_id)')
                ->from('Transfer r');
        return $q->fetchArray();
    }

    /**
     *
     * Executes save read TransferReason byId  function
     * 
     * @param type $id
     * @return type 
     */
    public function readTransferReasonbyId($id) {
        return Doctrine::getTable('TransferReason')->find($id);
    }

    /**
     *
     * Executes save read getEmployee byId  function
     * 
     * @param type $id
     * @return type 
     */
    public function getEmployeeId($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    /**
     *
     * Executes save readTranfer function
     * 
     * @param type $id
     * @return type 
     */
    public function readTranfer($id) {
        return Doctrine::getTable('Transfer')->find($id);
    }

    /**
     *
     * Executes getJoinedDate function
     * 
     * @param type $id
     * @return type 
     */
    public function getJoinedDate($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    /**
     *
     * Executes deleteReason function
     * 
     * @param type $id
     * @return type 
     */
    public function deleteReason($id) {
        $q = Doctrine_Query::create()
                ->delete('TransferReason')
                ->where('trans_reason_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes deleteRequest function
     * 
     * @param type $id
     * @return type 
     */
    public function deleteRequest($id) {
      

        $q = Doctrine_Query::create()
                ->from('TransferRequest t')
                ->where("t.trans_req_id = ?", $id);

        $Results=$q->fetchArray();

        $wfMainId=$Results[0]['wfmain_id'];

          $q = Doctrine_Query::create()
                ->delete('TransferRequest')
                ->where('trans_req_id=' . $id);
        $numDeleted = $q->execute();

        $q = Doctrine_Query::create()
                ->delete('WfMainAppPerson w')                           
                ->where('w.wfmain_id=' . $wfMainId);
         $numDeleted = $q->execute();

            $q = Doctrine_Query::create()
                ->delete('WfMain m')
                 ->where('m.wfmain_id=' . $wfMainId)
                 ->andWhere('m.wfmain_iscomplete_flg=0');

          $numDeleted = $q->execute();

        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes deleteTransfer function
     * 
     * @param type $id
     * @return type 
     */
    public function deleteTransfer($id) {
        $q = Doctrine_Query::create()
                ->delete('Transfer')
                ->where('trans_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes deleteTransferReason function
     * 
     * @param type $id
     * @return type 
     */
    public function deleteTransferReason($id) {
        $q = Doctrine_Query::create()
                ->delete('TransferRequest')
                ->where('trans_req_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    /**
     *
     * Executes ajaxData function
     * 
     * @param type $id
     * @return type 
     */
    public function ajaxData($id) {
        $q = Doctrine_Query::create()
                ->from('Employee e')
                ->innerJoin('e.subDivision c')
                ->where("e.emp_number = ?", $id);

        return $q->fetchArray();
    }

    /**
     *
     * Executes get_path function
     * 
     * @param type $node
     * @param type $culture
     * @return type 
     */
    function get_path($node, $culture="") {
        // look up the parent of this node

        $q = Doctrine_Query::create()
                ->from('CompanyStructure c')
                ->where("c.id = ?", $node);


        //$result = mysql_query("SELECT parnt,title FROM hs_hr_compstructtree WHERE id='$node'");

        $row = $q->fetchArray();

        // save the path in this array
        $path = array();

        // only continue if this $node isn't the root node
        // (that's the node with no parent)
        if ($row[0]['parnt'] != 0) {
            // the last part of the path to $node, is the name
            // of the parent of $node
            if ($culture == "si") {
                $title1 = $row[0]['title_si'];
                if ($title1 == "") {
                    $path[] = $row[0]['title'];
                } else {
                    $path[] = $row[0]['title_si'];
                }
            } elseif ($culture == "ta") {

                $title2 = $row[0]['title_ta'];
                if ($title2 == "") {
                    $path[] = $row[0]['title'];
                } else {
                    $path[] = $row[0]['title_ta'];
                }
            } else {



                $path[] = $row[0]['title'];
            }



            // we should add the path to the parent of this node
            // to the path
            $path = array_merge($this->get_path($row[0]['parnt'], $culture), $path);
        }

        // return the path
        return $path;
    }

    /**
     *
     * Executes fetchTransferReason function
     * 
     * @return type 
     */
    public function fetchTransferReason() {
        try {

            $q = Doctrine_Query::create()
                    ->from('TransferReason');

            return $q->execute();
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    /**
     *
     * Executes getDepartment function
     * 
     * @param type $id
     * @return type 
     */
    public function getDepartment($id) {
        try {
            return Doctrine::getTable('CompanyStructure')->find($id);
        } catch (Exception $e) {
            throw new DaoException($e->getMessage());
        }
    }

    /**
     *
     * Executes getDep function
     * 
     * @param type $id
     * @return type 
     */
    public function getDep($id) {
        $q = Doctrine_Query::create()
                ->from('CompanyStructure c')
                ->where("c.id = ?", $id);

        return $q->execute();
    }

    /**
     *
     * Executes deleteImage function
     * 
     * @param type $id
     * @return type 
     */
    public function deleteImage($id) {

        $q = Doctrine_Query::create()
                ->update('Transfer t')
                ->set('t.trans_image', '?', "")
                ->set('t.trans_image_name', '?', "")
                ->where('t.trans_id = ?', $id);

        $q->execute();
        return true;
    }

    /**
     *
     * Executes deleteAttachment function
     * 
     * @param type $attachId
     * @return type 
     */
    public function deleteAttachment($attachId) {

        $q = Doctrine_Query::create()
                ->delete('TransferAttach')
                ->where('trans_id =' . $attachId);

        $q->execute();
        return true;
    }


    /**
     *
     * Executes saveTransferRequest function
     * 
     * @param TransferRequest $transreq
     * @return type 
     */
    public function saveTransferRequest(TransferRequest $transreq) {
        $transreq->save();
        return true;
    }

    /**
     *
     * Executes getLastRequestID function
     * 
     * @return type 
     */
    public function getLastRequestID() {
        $q = Doctrine_Query::create()
                ->select('MAX(trans_req_id)')
                ->from('TransferRequest r');
        return $q->fetchArray();
    }

    /**
     *
     * Executes readTransferRequestbyId function
     * 
     * @param type $id
     * @return type 
     */
    public function readTransferRequestbyId($id) {
        return Doctrine::getTable('TransferRequest')->find($id);
    }
   

    /**
     *
     * Executes getLastEffectiveDate function
     * 
     * @param type $id
     * @return type 
     */
    public function getLastEffectiveDate($id) {
        $q = Doctrine_Query::create()
                ->select('MAX(trans_effect_date)')
                ->from('Transfer r')
                ->where('r.trans_emp_number = ?', $id);
        return $q->fetchArray();
    }

    /**
     *
     * Executes getAttachdetails function
     * 
     * @param type $id
     * @return type 
     */
//    public function getAttachdetails($id) {
//
//        $q = Doctrine_Query::create()
//                ->select('t.*')
//                ->from('TransferAttach t')
//                ->where('t.trans_attach_id = ?', $id);
//
//        return $q->fetchArray();
//    }

    /**
     *
     * Executes getComDate function
     * 
     * @param type $empId
     * @return type 
     */
    public function getComDate($empId) {

        $q = Doctrine_Query::create()
                ->select('e.emp_com_date')
                ->from('Employee e')
                ->where('e.empNumber = ?', $empId);

        return $q->fetchArray();
    }

    /**
     *
     * Executes readGetEmployeeId function
     * 
     * @param type $id
     * @return type 
     */
    public function readGetEmployeeId($id) {
        return Doctrine::getTable('Employee')->find($id);
    }

    
    /**
     *
     * Executes getLevelList function
     * 
     * @return type 
     */
    public function getLevelList() {
        $q = Doctrine_Query::create()
                ->select('l.*')
                ->from('CompanyStructureLevels l')
                ->where('l.def_level != ' . 1);
        return $q->execute();
    }

    /**
     *
     * Executes loadSubList function
     * 
     * @param type $id
     * @return type 
     */
    public function loadSubList($id) {

        $sysConf = OrangeConfig::getInstance()->getSysConf();
        $Headoffice = $sysConf->Headoffice;

        $q = Doctrine_Query::create()
                ->select('c.id,c.title,c.title_si,c.title_ta')
                ->from('CompanyStructure c')
                ->where('c.def_level = ?', array($id))
                ->andwhere('c.parnt  != ?', $Headoffice);

        return $q->fetchArray();
    }

    /**
     *
     * Executes loadHeadOfficeDevision function
     * 
     * @param type $id
     * @return type 
     */
    public function loadHeadOfficeDevision($id) {

        $sysConf = OrangeConfig::getInstance()->getSysConf();
        $Headoffice = $sysConf->Headoffice;

        if ($id == $Headoffice) {
            $q = Doctrine_Query::create()
                    ->select('c.id,c.title.c.title_si,c.title_ta')
                    ->from('CompanyStructure c')
                    ->where('c.def_level = ?', array(4))
                    ->andwhere('c.parnt  = ?', $Headoffice);
            return $q->fetchArray();
        }
    }

    /**
     * 
     * Executes readWFRecord function
     * 
     * @param type $id
     * @return type 
     */
    public function readWFRecord($id) {

        $q = Doctrine_Query::create()
                ->select('tr.*')
                ->from('TransferRequest tr')
                ->where('tr.wfmain_id=' . $id);
        return $q->fetchOne();
    }

    /**
     * 
     * Executes getCompanyStructureDetailRole function
     *
     * @param type $empid
     * @param type $Role
     * @return type 
     */
    public function getCompanyStructureDetailRole($empid, $Role) {        
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('CompanyStructureDetails e')
                ->where('e.emp_number = ?', $empid)
                ->Andwhere('e.role_group_id = ?', $Role);
        return $q->fetchone();
    }

    /**
     *
     * Executes readworkflowdeleteAssign function
     * 
     * @param type $cId
     * @param type $empID
     * @return type 
     */
    public function readworkflowdeleteAssign($cId, $empID) {


        $q = Doctrine_Query::create()
                ->select('*')
                ->from('TrainAssign a')
                ->where('a.emp_number = ?', array($empID))
                ->andwhere('a.td_course_id = ?', array($cId));


        return $q->fetchArray();
    }

     public function  getTransReasonObject($request,$transferReason) {

                if (strlen($request->getParameter('txtReason'))) {
                    $transferReason->setTrans_reason_en(trim($request->getParameter('txtReason')));
                } else {
                    $transferReason->setTrans_reason_en(null);
                }
                if (strlen($request->getParameter('txtReasonsi'))) {
                    $transferReason->setTrans_reason_si(trim($request->getParameter('txtReasonsi')));
                } else {
                    $transferReason->setTrans_reason_si(null);
                }
                if (strlen($request->getParameter('txtReasonta'))) {
                    $transferReason->setTrans_reason_ta(trim($request->getParameter('txtReasonta')));
                } else {
                    $transferReason->setTrans_reason_ta(null);
                }
                return $transferReason;
     }

     public function isEmployeeInGroup($employee,$SecuGroupIdOne){

         $q = Doctrine_Query::create()
                ->select('a.emp_number')
                ->from('CompanyStructureDetails a')
                ->where('a.emp_number = ?', array($employee))
                ->andwhere('a.role_group_id = ?', array($SecuGroupIdOne));


        return $q->fetchone();

     }

     public function getComCode($id){
          $q = Doctrine_Query::create()
                ->select('comp_code')
                ->from('CompanyStructure')
                ->where('id = ?', array($id));
                


        return $q->fetchone();
     }
     public function deleteTransferAttachement($id){
         
             $q = Doctrine_Query::create()
                ->delete('TransferAttach')
                ->where('trans_id=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
         
     }
    public function checkChargeSheet($id){
         $q = Doctrine_Query::create()
                ->select('COUNT(a.trans_id)')
                ->from('TransferAttach a')
                ->where('a.trans_id = ?', array($id));
               


        return $q->fetchArray();
    }

    public function readChargeSheet($id) {

        $q = Doctrine_Query::create()
                ->from('TransferAttach d')
                ->where('d.trans_id = ?', array($id));
               
        return $q->execute();
    }

    public function getJobRoleOfEmployeeById($id){


          $q = Doctrine_Query::create()
                ->select('a.*')
                ->from('CompanyStructureDetails a')
                ->where('a.emp_number = ?', array($id));

        $results=$q->fetchOne();
         return $results;


    }

    public function LoadHeadOfficeList($id,$Culture) {
    $this->display_children($id);

    $comDetailsArr=array();

    foreach($this->headOfficeIds as $key=>$value){
        $query = 'SELECT * FROM hs_hr_compstructtree c   WHERE id="' . $value . '";';

       

    $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

           $n = "title_" . $Culture;
            if ($row[$n] == null) {
                $n = "title";
            } else {
                $n = "title_" . $Culture;
            }
            
            $comDetailsArr[$row['id']] = $row[$n];
           
        }
        
    }
//print_r($comDetailsArr);die;
        return  $comDetailsArr;
    }
    function display_children($parent='') {

    $query = 'SELECT * FROM hs_hr_compstructtree c   WHERE parnt="' . $parent . '";';

  

    $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {
            
            $this->headOfficeIds[] = $row['id'];
             $this->display_children($row['id']);
        }
        

}
    function display_parent($child=''){

            $query = 'SELECT * FROM hs_hr_compstructtree c   WHERE id="' . $child . '";';



    $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $this->headOfficeIds[] = $row['parnt'];
             $this->display_parent($row['parnt']);
        }
        
    }
    public function getPreferedDivisionDistrict($id) {
       
        $this->display_parent($id);
        return $this->headOfficeIds;
    }
    public function getLastApprovedLevel($id){

         $query = "SELECT * FROM hs_hr_wf_main m   WHERE  wfmain_sequence=(select max(wfmain_sequence) from hs_hr_wf_main m where wfmain_id={$id} and wfmain_approving_emp_number is not null) and wfmain_id={$id}";



         $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $appEmpNum = $row['wfmain_approving_emp_number'];
             
        }

        return $appEmpNum;
   

   

    }
 public function getAttachdetails($id) {

        $query = Doctrine_Query::create()
                        ->select('t.*')
                        ->from('TransferAttach t')
                        ->where('t.trans_id = ?', $id)
                        ->orderBy('t.trans_attach_id DESC');

        return $query->fetchArray();
    }
    
    public function deleteImageAttach($id) {

        $q = Doctrine_Query::create()
                ->delete('TransferAttach t')
                ->where('t.trans_id = ?', $id);

        $q->execute();
        return true;
    }
    public function getDivisionHeadComments($id){

        $q = Doctrine_Query::create()
                ->select('m.*')
                ->from('WfMain m')
                ->where('m.wfmain_id = ?', $id)
                ->andWhere('m.wfmain_iscomplete_flg=1');

       
      return $q->fetchArray();


       
    }
    
        public function getDivisionHeadComments1($id){

        $q = Doctrine_Query::create()
                ->select('m.*')
                ->from('WfMain m')
                ->where('m.wfmain_id = ?', $id)
                ->andWhere('m.wfmain_iscomplete_flg=-1');

       
      return $q->fetchArray();


       
    }
}

?>
