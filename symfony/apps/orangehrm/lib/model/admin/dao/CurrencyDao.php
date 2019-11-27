<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Currency Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class CurrencyDao extends BaseDao {

   public function getCurrencyList() {

			$query = Doctrine_Query::create()
			    ->from('CurrencyType c')
			    ->orderBy('c.currency_name');

			return $query->execute();

   }
}
?>