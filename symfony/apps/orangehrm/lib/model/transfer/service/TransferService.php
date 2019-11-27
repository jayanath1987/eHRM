<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Transfer Module TransferService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class TransferService extends BaseService {

    private $transferDao;

    /**
     * TransferService construct
     */
    public function __construct() {
        $this->transferDao = new TransferDao();
    }

    public function saveAdminRequestSub($request){
            return $this->transferDao->saveAdminRequestSub($request);
    }
    public function saveTransferRequestSub($request){
        return $this->transferDao->saveTransferRequestSub($request);
    }

    /**
     * 
     * Executes saveTransReason Service
     *
     * @param TransferReason $trans
     * @return type 
     */
    public function saveTransReason(TransferReason $trans) {
        return $this->transferDao->saveTransReason($trans);
    }

    /**
     *
     * Executes saveTransfer Service
     * 
     * @param Transfer $trans
     * @return type 
     */
    public function saveTransfer(Transfer $trans) {
        return $this->transferDao->saveNewTransfer($trans);
    }

    /**
     *
     * Executes readTransferReasonbyId Service
     * 
     * @param type $id
     * @return type 
     */
    public function readTransferReasonbyId($id) {
        return $this->transferDao->readTransferReasonbyId($id);
    }

    /**
     *
     * Executes deleteReason Service
     * 
     * @param type $id
     * @return type 
     */
    public function deleteReason($id) {
        return $this->transferDao->deleteReason($id);
    }

    /**
     *
     * Executes deleteRequest Service
     * 
     * @param type $id
     * @return type 
     */
    public function deleteRequest($id) {
        return $this->transferDao->deleteRequest($id);
    }

    
    /**
     *
     * Executes saveTransferRequest Service
     * 
     * @param TransferRequest $trans
     * @return type 
     */
    public function saveTransferRequest(TransferRequest $trans) {
        return $this->transferDao->saveTransferRequest($trans);
    }

    /**
     *
     * Executes readTransferRequestbyId Service
     * 
     * @param type $id
     * @return type 
     */
    public function readTransferRequestbyId($id) {
        return $this->transferDao->readTransferRequestbyId($id);
    }

    /**
     *
     * Executes getJoinedDate Service
     * 
     * @param type $id
     * @return type 
     */
    public function getJoinedDate($id) {
        return $this->transferDao->getJoinedDate($id);
    }

    /**
     *
     * Executes saveNewTransfer Service
     * 
     * @param Transfer $trans
     * @return type 
     */
    public function saveNewTransfer(Transfer $trans) {
        return $this->transferDao->saveNewTransfer($trans);
    }

    /**
     *
     * Executes fetchTransferReason Service
     * 
     * @return type 
     */
    public function fetchTransferReason() {
        return $this->transferDao->fetchTransferReason();
    }

    /**
     *
     * Executes updateEmpMaster Service
     * 
     * @param Employee $emp
     * @return type 
     */
    public function updateEmpMaster(Employee $emp) {
        return $this->transferDao->updateEmpMaster($emp);
    }

    /**
     *
     * Executes readGetEmployeeId Service
     * 
     * @param type $eid
     * @return type 
     */
    public function readGetEmployeeId($eid) {
        return $this->transferDao->getEmployeeId($eid);
    }

    /**
     *
     * Executes getLevelList Service
     * 
     * @return type 
     */
    public function getLevelList() {
        return $this->transferDao->getLevelList();
    }

    /**
     *
     * Executes loadSubList Service
     * 
     * @param type $id
     * @return type 
     */
    public function loadSubList($id) {
        return $this->transferDao->loadSubList($id);
    }
    public function LoadHeadOfficeList($id,$Culture) {
        return $this->transferDao->LoadHeadOfficeList($id,$Culture);
    }


    /**
     *
     * Executes loadHeadOfficeDevision Service
     * 
     * @param type $id
     * @return type 
     */
    public function loadHeadOfficeDevision($id) {
        return $this->transferDao->loadHeadOfficeDevision($id);
    }

    /**
     * 
     * Executes readWFRecord Service
     *
     * @param type $id
     * @return type 
     */
    public function readWFRecord($id) {
        return $this->transferDao->readWFRecord($id);
    }

    /**
     *
     * Executes getCompanyStructureDetailRole Service
     * 
     * @param type $empid
     * @param type $Role
     * @return type 
     */
    public function getCompanyStructureDetailRole($empid, $Role) {
        return $this->transferDao->getCompanyStructureDetailRole($empid, $Role);
    }

    /**
     *
     * Executes readworkflowdeleteAssign Service 
     * 
     * @param type $cId
     * @param type $empID
     * @return type 
     */
    public function readworkflowdeleteAssign($cId, $empID) {
        return $this->transferDao->readworkflowdeleteAssign($cId, $empID);
    }

    /**
     *
     * Executes getLastTransferID Service 
     * 
     * @return type 
     */
    public function getLastTransferID() {
        return $this->transferDao->getLastTransferID();
    }

    /**
     *
     * Executes saveNewAttachment Service
     * 
     * @param TransferAttach $transattach
     * @return type 
     */
    public function saveNewAttachment(TransferAttach $transattach) {
        return $this->transferDao->saveNewAttachment($transattach);
    }

    /**
     *
     * Executes readTranfer Service
     * 
     * @param type $id
     * @return type 
     */
    public function readTranfer($id) {
        return $this->transferDao->readTranfer($id);
    }

    /**
     *
     * Executes ajaxData Service
     * 
     * @param type $id
     * @return type 
     */
    public function ajaxData($id) {
        return $this->transferDao->ajaxData($id);
    }

    /**
     *
     * Executes get_path Service
     * 
     * @param type $node
     * @param type $culture
     * @return type 
     */
    public function get_path($node, $culture) {
        return $this->transferDao->get_path($node, $culture);
    }

    /**
     *
     * Executes getLastEffectiveDate Service
     * 
     * @param type $id
     * @return type 
     */
    public function getLastEffectiveDate($id) {
        return $this->transferDao->getLastEffectiveDate($id);
    }
     public function  getTransReasonObject($request,$transReason) {
        return $this->transferDao->getTransReasonObject($request,$transReason);
    }

    public function isEmployeeInGroup($employee,$SecuGroupIdOne){
        return $this->transferDao->isEmployeeInGroup($employee,$SecuGroupIdOne);
    }
    public function getComCode($code){
        return $this->transferDao->getComCode($code);
    }
    public function deleteTransfer($id){
        return $this->transferDao->deleteTransfer($id);
    }
    public function deleteTransferAttachement($id){
        return $this->transferDao->deleteTransferAttachement($id);
    }
    
     public function checkChargeSheet($id){
        return $this->transferDao->checkChargeSheet($id);
    }
     public function readChargeSheet($id){
        return $this->transferDao->readChargeSheet($id);
    }
    public function  getPreferedDivisionDistrict($id){
        return $this->transferDao->getPreferedDivisionDistrict($id);
    }
   



}

?>
