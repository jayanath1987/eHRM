<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module MembershipService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class MembershipService extends BaseService {
   private $membershipDao;


   public function __construct() {
      $this->membershipDao = new MembershipDao();
   }


   public function setMembershipDao(MembershipDao $membershipDao) {
      $this->membershipDao = $membershipDao;
   }


   public function getMembershipDao() {
      return $this->membershipDao;
   }


   public function getMembershipTypeList($orderField = 'membtype_code', $orderBy = 'ASC') {

         return $this->membershipDao->getMembershipTypeList($orderField, $orderBy);

   }


   public function saveMembershipType(MembershipType $membershipType) {

         return $this->membershipDao->saveMembershipType($membershipType);

   }


   public function deleteMembershipType($membershipType = array()) {

         return $this->membershipDao->deleteMembershipType($membershipType);

   }


   public function searchMembershipType($searchMode, $searchValue) {

         return $this->membershipDao->searchMembershipType($searchMode, $searchValue);

   }


   public function readMembershipType($id) {

         return $this->membershipDao->readMembershipType($id);

   }


   public function getMembershipList($orderField='membship_code', $orderBy='ASC') {

         return $this->membershipDao->getMembershipList($orderField, $orderBy);

   }


   public function saveMembership(Membership $membership) {

         return $this->membershipDao->saveMembership($membership);

   }


   public function deleteMembership($membershipList = array()) {

         return $this->membershipDao->deleteMembership($membershipList);

   }


   public function searchMembership($searchMode, $searchValue) {

         return $this->membershipDao->searchMembership($searchMode, $searchValue);

   }


   public function readMembership($id) {

         return $this->membershipDao->readMembership($id);

   }
}
?>