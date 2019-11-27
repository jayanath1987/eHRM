<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Nationality Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class NationalityDao extends BaseDao {


   public function getNationalityList($orderField = 'nat_code', $orderBy = 'ASC') {

         $q = Doctrine_Query::create()
             ->from('Nationality')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();

   }


   public function saveNationality(Nationality $nationality) {

         if( $nationality->getNatCode() == '') {
            $idGenService	=	new IDGeneratorService();
            $idGenService->setEntity($nationality);
            $nationality->setNatCode( $idGenService->getNextID() );
         }
         $nationality->save();
         return true;

   }


   public function deleteNationality($nationalityList = array()) {

         if(is_array($nationalityList )) {
            $q = Doctrine_Query::create()
               ->delete('Nationality')
               ->whereIn('nat_code', $nationalityList);

            $numDeleted = $q->execute();
            if($numDeleted > 0) {
               return true;
            }
            return false;
         }

   }


   public function searchNationality($searchMode, $searchValue) {

         $searchValue	=	trim($searchValue);
         $q = 	Doctrine_Query::create( )
               ->from('Nationality')
               ->where("$searchMode = ?",$searchValue);

         return $q->execute();

   }


   public function readNationality($id) {

         return Doctrine::getTable('Nationality')->find($id);

   }


   public function getEthnicRaceList($orderField='ethnic_race_code', $orderBy='ASC') {

         $q = Doctrine_Query::create()
             ->from('EthnicRace')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();

   }


   public function saveEthnicRace(EthnicRace $ethnicRace) {

         if( $ethnicRace->getEthnicRaceCode()== '') {
            $idGenService	=	new IDGeneratorService();
            $idGenService->setEntity($ethnicRace);
            $ethnicRace->setEthnicRaceCode($idGenService->getNextID());
         }
         $ethnicRace->save();
         return true;

   }


   public function deleteEthnicRace($ethnicRaceList = array()) {

         if(is_array($ethnicRaceList)) {
            $q = Doctrine_Query::create()
                ->delete('EthnicRace')
                ->whereIn('ethnic_race_code', $ethnicRaceList );

            $numDeleted = $q->execute();
            if($numDeleted > 0) {
               return true;
            }
            return false;
         }

   }


   public function searchEthnicRace($searchMode, $searchValue) {

         $q = 	Doctrine_Query::create()
            ->from('EthnicRace')
            ->where("$searchMode = ?", trim($searchValue));

         return $q->execute();

   }
}
?>