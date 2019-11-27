<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module LanguageService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class LanguageService extends BaseService {
   private $languageDao;


   public function __construct() {
      $this->languageDao = new LanguageDao();
   }


   public function getLanguageList($orderField = 'lang_code', $orderBy = 'ASC') {
        return $this->languageDao->getLanguageList($orderField, $orderBy);
   }


   public function searchLanguage( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'lang_code', $orderBy = 'ASC')
   {
        return $this->languageDao->searchLanguage($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy);
   }


    public function saveLanguage(Language $language)
    {
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->languageDao->saveLanguage($language);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_language',array($language->lang_code),1);

        $conn->commit();
    }


    public function deleteLanguage($entriesToDelete)
    {
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        foreach ($entriesToDelete as $id) {
            $conHandler = new ConcurrencyHandler();
            $recordLocked = $conHandler->isTableLocked('hs_hr_language',array($id),1);

            if ($recordLocked==false) {
                $this->languageDao->deleteLanguage($id);
            }
        }

        $conn->commit();
        return true;
    }


    public function readLanguage( $id )
    {
        return $this->languageDao->readLanguage($id);
    }


    public function getLanguageById( $id )
    {
        return $this->languageDao->getLanguageById($id);
    }   
}
?>