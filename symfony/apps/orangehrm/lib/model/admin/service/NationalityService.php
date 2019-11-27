<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module NationalityService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class NationalityService extends BaseService {
   private $nationalityDao;


   public function __construct() {
      $this->nationalityDao = new NationalityDao();
   }


   public function setNationalityDao(NationalityDao $nationalityDao) {
      $this->nationalityDao = $nationalityDao;
   }


   public function getNationalityDao($param) {
      return $this->nationalityDao;
   }


   public function getNationalityList($orderField = 'nat_code', $orderBy = 'ASC') {

         return $this->nationalityDao->getNationalityList($orderField, $orderBy);

   }


   public function saveNationality(Nationality $nationality) {

         return $this->nationalityDao->saveNationality($nationality);

   }


   public function deleteNationality($nationalityList = array()) {

         return $this->nationalityDao->deleteNationality($nationalityList);

   }


   public function searchNationality($searchMode, $searchValue) {

         return $this->nationalityDao->searchNationality($searchMode, $searchValue);

   }


   public function readNationality($id) {

         return $this->nationalityDao->readNationality($id);

   }


   public function getEthnicRaceList($orderField = 'ethnic_race_code', $orderBy = 'ASC') {

         return $this->nationalityDao->getEthnicRaceList($orderField, $orderBy);

   }


   public function saveEthnicRace(EthnicRace $ethnicRace) {

         return $this->nationalityDao->saveEthnicRace($ethnicRace);

   }


   public function deleteEthnicRace($ethnicRaceList = array()) {

         return $this->nationalityDao->deleteEthnicRace($ethnicRaceList);

   }


   public function searchEthnicRace($searchMode, $searchValue) {

         return $this->nationalityDao->searchEthnicRace($searchMode, $searchValue);

   }
}
?>