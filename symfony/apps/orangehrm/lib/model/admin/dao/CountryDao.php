<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Country Data Access Functions
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class CountryDao extends BaseDao {
	

	public function getCountryList( ) {

			$q = Doctrine_Query::create()
			    ->from('Country c')
			    ->orderBy('c.name');
			    
			$countryList	=	$q->execute();
			
			return $countryList ;

	}
	

	public function getProvinceList($countryCode = NULL) {

			$q = Doctrine_Query::create()
			    ->from('Province p');

            if (!empty($countryCode)) {
                $q->where('cou_code = ?', $countryCode);
            }
            
			$q->orderBy('p.province_name');
			    
			$provinceList	=	$q->execute();
			
			return $provinceList ;

	}

    
}