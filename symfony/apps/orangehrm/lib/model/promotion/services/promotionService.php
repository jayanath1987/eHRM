<?php
/**
 * Service class for Promotion Module
 *
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 07 September 2011 
 *  Comments  - Employee Promotion Functions 
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class promotionService extends BaseService {
   private $promotionDao;

   /**
    * Constructor
    */
   public function __construct() {
      $this->promotionDao = new promotionDao();
   }

   /**
    * Set JobDao
    * @param JobDao $jobDao
    */
   public function setpromotionDao(promotionDao $promotionrDao) {
      $this->promotionDao = $promotionrDao;
   }

   /**
    * Return JobDao
    * @returns JobDao
    */
   public function getpromotionDao() {
      return $this->promotionDao;
   }

   

   

   public function searchPromotionTitle($searchMode, $searchValue) {

         return $this->promotionDao->searchReasonTitle($searchMode, $searchValue);

   }

   public function searchReasonTitle($searchMode, $searchValue) {

         return $this->promotionDao->searchReasonTitle($searchMode, $searchValue);

   }

   public function savePromotionMethod(PromotionMethod $trans) {

         return $this->promotionDao->savePromotionMethod($trans);

   }
   
   public function readPromotion($id) {

         return $this->promotionDao->readPromotion($id);

   }
   
   public function getGradeSlotLoadID($yr,$grade) {

         return $this->promotionDao->getGradeSlotLoadID($yr,$grade);

   }
   
    public function getEmployeerecord($id) {

         return $this->promotionDao->getEmployeerecord($id);

   }
   public function getPrmfrmLoadGrd() {

         return $this->promotionDao->getPrmfrmLoadGrd();

   }
   
   public function getPrmfrmLoadDesc() {

         return $this->promotionDao->getPrmfrmLoadDesc();

   }
   
   public function getPrmfrmLoadEType() {

         return $this->promotionDao->getPrmfrmLoadEType();

   }
   
   public function getPrmfrmLoadPMsevice() {

         return $this->promotionDao->getPrmfrmLoadPMsevice();

   }
   
   public function getPrmfrmLoadPMethod() {

         return $this->promotionDao->getPrmfrmLoadPMethod();

   }
   
   public function getClassLoad() {

         return $this->promotionDao->getClassLoad();

   }
   public function getGradeLoad() {

         return $this->promotionDao->getGradeLoad();

   }
   public function getLevelLoad() {

         return $this->promotionDao->getLevelLoad();

   }
   public function  saveNewPromotion(Promotion $promotion) {

         return $this->promotionDao->saveNewPromotion($promotion);

   }
   
   public function  saveNewAttachment(PromotionAttachment $prmattach) {

         return $this->promotionDao->saveNewAttachment($prmattach);

   }
   
   public function  updateEmpMaster($varibleList) {

         return $this->promotionDao->updateEmpMaster($varibleList);

   }
   
   public function getLastID() {

         return $this->promotionDao->getLastID();

   }
   
   public function readPromotionMethod($id) {

         return $this->promotionDao->readPromotionMethod($id);

   }
   
  
   
   
   
   public function deleteAttach1($id) {

         return $this->promotionDao->deleteAttach1($id);

   } 

   public function delchecklistdetails($id) {

         return $this->promotionDao->delchecklistdetails($id);

   } 
   

   
   
   
   public function savePromotioncklist(PromotionCkecklist $chklist,$request) {

         return $this->promotionDao->savePromotioncklist($chklist,$request);

   }
   
   
   
   public function savecklistdetails(PromotionChecklistDetail $ChecklistDetail) {

         return $this->promotionDao->savecklistdetails($ChecklistDetail);

   }
   
   
   
   public function readOtherInstitution($id){
       
       return $this->promotionDao->readOtherInstitution($id);
   
   }
   
   public function saveOtherInstitution(OtherInstitute $OtherInstitute) {

         return $this->promotionDao->saveOtherInstitution($OtherInstitute);

   }
   
   public function getEmployee($id){
       return $this->promotionDao->getEmployee($id);
   }
   
   public function saveEmployee(Employee $Employee) {

         return $this->promotionDao->saveEmployee($Employee);

   }
   
  public function readCompanyStructure($id) {

         return $this->promotionDao->readCompanyStructure($id);

   } 
   
  public function readDeflevelById($id) {
         
        return $this->promotionDao->readDeflevelById($id);
  }
  
  public function getGradeSlot($id) {
         
        return $this->promotionDao->getGradeSlot($id);
  }
   
   public function getPendingUpadatePromotions(){
       
       return $this->promotionDao->getPendingUpadatePromotions();
   }
   
  
   public function getPromotionServiceObj($PromotionMethod,$request) {
        return $this->promotionDao->getPromotionServiceObj($PromotionMethod,$request);
    }
 }
?>
