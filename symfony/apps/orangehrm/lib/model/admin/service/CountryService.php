<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CountryService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class CountryService extends BaseService {
    
	private $countryDao ;
	

	public function getCountryDao(){
		return $this->countryDao;
	}


	public function setCountryDao(CountryDao $countryDao){
		$this->countryDao	=	$countryDao ;
	}
	

	public function getCountryList( )
	{
 
			$countryList	=	$this->countryDao->getCountryList();
			return $countryList ;

	}


	public function getProvinceList($countryCode = NULL)
	{

			$provinceList	=	$this->countryDao->getProvinceList($countryCode);
			return $provinceList ;

	}
}