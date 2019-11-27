<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Language Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

require_once '../../lib/common/LocaleUtil.php';
class LanguageDao extends BaseDao {


   public function getLanguageList($orderField = 'lang_code', $orderBy = 'ASC') {
         $q = Doctrine_Query::create()
             ->from('Language')
             ->orderBy($orderField.' '.$orderBy);

         return $q->execute();
   }


   public function searchLanguage( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'lang_code', $orderBy = 'ASC' )
   {
        $searchColumn = ($userCulture == "en") ? $searchMode : $searchMode . '_' . $userCulture;

        if ($orderField!='lang_code') {
            $orderField = ($userCulture == "en") ? $orderField : $orderField . '_' . $userCulture;
        }

        $searchValue	=	trim($searchValue);
        $q 		= 	Doctrine_Query::create( )
                                ->from('Language');

        if ( $searchMode !='all' && $searchValue !='') {
            $q->where($searchColumn . " LIKE ?", '%' . trim($searchValue) . '%');
        }
        
        $q->orderBy($orderField.' '.$orderBy);

          $sysConf=new sysConf();
        $resultsPerPage = $sysConf->getRowLimit()?$sysConf->getRowLimit():10;

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
          "?page={%page_number}&amp;mode=search&amp;txtSearchValue={$searchValue}&amp;cmbSearchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}"
        );

        $pager  = $pagerLayout->getPager();
        $result = array();
        $result['data']     = $pager->execute();
        $result['pglay']    = $pagerLayout;

        return $result;
    }


    public function saveLanguage(Language $language)
    {
        if( $language->getLangCode() == '')
        {
            $idGenService	=	new IDGeneratorService();
            $idGenService->setEntity($language);
            $language->setLangCode( $idGenService->getNextID() );
        }
        $language->save();
        return true;
    }


    public function deleteLanguage( $id )
    {
        $q = Doctrine_Query :: create()->delete('Language')
                ->where('lang_code = ?', $id);

       
        return $q->execute();
    }


    public function readLanguage( $id )
    {
        $language = Doctrine::getTable('Language')->find($id);
        return $language;
    }


    public function getLanguageById( $id )
    {
        $q 	= 	Doctrine_Query::create()
                        ->select('l.*')
                        ->from('Language l')
                        ->where('lang_code = ?', $id);

        return $q->fetchArray();
    }
}
?>