<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */
class ReportDataDAO {
	
	private $doctrinQuery;
	public $pager;
	public $onlyCount;
	
	public function __construct() {		
		$this->doctrinQuery = Doctrine_Query::create();		
	}
	
	public function setDoctrinQuery($doctrinQuery) {
		$this->doctrinQuery = $doctrinQuery;
	}

	public function getDoctrinQuery() {
		return $this->doctrinQuery;
	}
	

	public function setPager($pager) {
		$this->pager = $pager;
	}

	public function getPager() {
		return $this->pager;
	}
	
	public function setParentOrJoin ($tableAlias = "") {
		
		if(sizeof($this->doctrinQuery->getDqlPart('from')) > 0 ) {					
			$this->doctrinQuery->leftJoin(  $this->doctrinQuery->getRootAlias().".".$tableAlias);			
		} else {					
			$this->doctrinQuery->from($tableAlias);			
		}		
	}	
	
	public function setWhereCondtion($filed, $valus = null , $tableAlias = null){

		if($tableAlias !=null) {
			$aliasas = explode( " ", $tableAlias);		
			$aliasas = $aliasas [1].".";
		} else {
			$aliasas = '';
		}		
		
		if($this->__isWhereAndNeeded()) {
			$this->doctrinQuery->andWhere($aliasas.$filed, $valus);
		} else {			
			$this->doctrinQuery->where($aliasas.$filed, $valus);
		}
	}
	
	public function setBetweenCondtion ($filed, $valus = null , $tableAlias = null){
	  
	   if($tableAlias !=null) {
            $aliasas = explode( " ", $tableAlias);      
            $aliasas = $aliasas [1].".";
        } else {
            $aliasas = '';
        }       
        
        if($this->__isWhereAndNeeded()) {
            $this->doctrinQuery->andWhere($aliasas.$filed." >= ? AND ".$aliasas.$filed." <= ?", $valus);
        } else {        	
            $this->doctrinQuery->where( $aliasas.$filed." >= ? AND ".$aliasas.$filed." <= ?" , $valus);
        }
	}
	
	public function setWhereCondtions($filed, $valus =  null, $tableAlias){			
		if($this->__isWhereAndNeeded()) {			
			$this->doctrinQuery->andWhere($filed, $valus);
		} else {
			$this->doctrinQuery->where($filed, $valus);
		}	
	}
	
	private function __isWhereAndNeeded(){
		$whereExist = $this->doctrinQuery->getParams('where');		
		if($whereExist[1] >0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function setLikeCondition($filed, $valus){		
		$this->doctrinQuery->whereIn($filed." LIKE ? ", "%".$valus."%");
	}
	
	public function setNotInCondition($filed, $valus){
		//$this->doctrinQuery->whereIn($filed, $valus);
	}
	
	public function serWhereBetweenCondition($filed, $valus){
		
	}
	
	private function setOffset(){
		if($this->pager->getOffset() != null) {
			$this->doctrinQuery->offset($this->pager->getOffset());
		}
	}
	
	private function setLimit(){
		if($this->pager->getMaxPerPage() != null) {
			$this->doctrinQuery->limit($this->pager->getMaxPerPage());
		}
	}
	
	public function getReportDataCount(){
		return $this->getReportData();
	}
	
	public function getCount(){
		return $this->getReportData();
	}
	
	public function getReportData(){
		
		if($this->pager == null){
			return $this->doctrinQuery->count();
		} else {
			$this->setOffset();
			$this->setLimit();

			// Carefull when enabling this echo to test it will gives an docrine error sometimes
			//echo $this->doctrinQuery->getSql();
			
			return $this->doctrinQuery->execute ();	
		}
	}
}

?>