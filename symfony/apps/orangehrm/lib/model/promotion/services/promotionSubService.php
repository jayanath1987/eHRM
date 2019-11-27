<?php
/**
 * Service class for Promotion Module
 *
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 18 September 2011
 *  Comments  - Employee Promotion Functions
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class promotionSubService extends BaseService {
   private $promotionSubDao;

   /**
    * Constructor
    */
   public function __construct() {
      $this->promotionSubDao = new promotionSubDao();
   }
   public function getPromotionList($searchMode, $searchValue, $culture='en', $orderField = 'p.prm_id', $orderBy = 'ASC', $page = 1){

         return $this->promotionSubDao->getPromotionList($searchMode, $searchValue, $culture='en', $orderField = 'p.prm_id', $orderBy = 'ASC', $page = 1);

   }
   public function getPromotionReasonList($searchMode, $searchValue, $culture='en', $orderField, $orderBy = 'ASC', $page = 1){
         return $this->promotionSubDao->getPromotionReasonList($searchMode, $searchValue, $culture='en', $orderField, $orderBy = 'ASC', $page = 1);

   }
   public function deleteAttach($id) {

         return $this->promotionSubDao->deleteAttach($id);

   }
   public function deletePromotion($id) {

         return $this->promotionSubDao->deletePromotion($id);

   }

    public function getProbationlist($searchMode, $searchValue, $culture='en', $orderField = 'r.emp_number', $orderBy = 'ASC', $page = 1) {

         return $this->promotionSubDao->getProbationlist($searchMode, $searchValue, $culture='en', $orderField = 'r.emp_number', $orderBy = 'ASC', $page = 1);

   }

   public function searchOtherInstitution($searchMode, $searchValue, $culture='en', $orderField = 'o.oth_inst_id', $orderBy = 'ASC', $page = 1){

       return $this->promotionSubDao->searchOtherInstitution($searchMode, $searchValue, $culture='en', $orderField = 'o.oth_inst_id', $orderBy = 'ASC', $page = 1);

   }

    public function deleteReason($id) {

         return $this->promotionSubDao->deleteReason($id);

   }

   public function getPromotionckList($searchMode, $searchValue, $culture='en', $orderField = 'r.prm_checklist_id', $orderBy = 'ASC', $page = 1) {

         return $this->promotionSubDao->getPromotionckList($searchMode, $searchValue, $culture='en', $orderField = 'r.prm_checklist_id', $orderBy = 'ASC', $page = 1);

   }
    public function deleteOtherInstitution($id) {

         return $this->promotionSubDao->deleteOtherInstitution($id);

   }
   
    public function getHistoryPromotion($searchMode, $searchValue, $culture='en', $orderField = 'p.prm_id', $orderBy = 'ASC', $page = 1 ,$EmpNo , $EmpName){

         return $this->promotionSubDao->getHistoryPromotion($searchMode, $searchValue, $culture='en', $orderField = 'p.prm_id', $orderBy = 'ASC', $page = 1,$EmpNo, $EmpName);

   }

}
   ?>
