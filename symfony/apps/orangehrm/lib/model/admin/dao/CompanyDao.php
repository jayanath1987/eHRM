<?php

/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Company Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

class CompanyDao extends BaseDao {


   public function getCompany() {

         $q = Doctrine_Query::create()
			    ->from('CompanyGeninfo')
			    ->where("code = ?", "001");

         $companyGeninfo = $q->fetchOne();
         $info    = explode("|", $companyGeninfo->getGeninfoValues());
         $company = new Company();
         $company->setComCode($companyGeninfo->getCode());
         $company->comapanyName  =   $info[0];
         $company->country       =   $info[1];        
         
         return $company;

   }


   public function saveCompany(Company $company, CompanyStructure $companyStructure) {

         $infoStr = $company->comapanyName.'|'.$company->country;
         
         $q = Doctrine_Query::create()
			    ->from('CompanyGeninfo')
			    ->where("code = ?", "001");

         $companyGeninfo = $q->fetchOne();
         $companyGeninfo->setGeninfoValues($infoStr);
         $companyGeninfo->save();

         //Save root company structure information
         $companyStructure->save();         
         return true;


   }


   public function readCompanyStructure($id)
   {

         $q = Doctrine_Query::create()
            ->from('CompanyStructure cs')
            ->where("id = ?", $id);
         if($q->count() == 0) {
            return false;
         }
         return $q->fetchOne();         

   }


   public function getCompanyLocation($orderField = "loc_code", $orderBy = "ASC") {

         $q = Doctrine_Query::create()
             ->from("Location")
             ->orderBy($orderField . " " . $orderBy);
 
         return $q->execute();


   }


   public function saveCompanyLocation(Location $location) {

         if($location->getLocCode() == '') {
            $idGenService	=	new IDGeneratorService();
            $idGenService->setEntity($location);
            $location->setLocCode($idGenService->getNextID());
         }

         $location->save();
         return true;

   }


   public function deleteCompanyLocation($locationCodes = array()) {

         if(is_array($locationCodes)) {
            $q = Doctrine_Query::create()
                   ->delete('Location')
                   ->whereIn('loc_code', $locationCodes);

            $q->execute();
            return true ;
         }

   }


   public function searchCompanyLocation($param, $value) {

         $q = Doctrine_Query::create()
                ->from('Location')
                ->where("$param = ?",trim($value));

         return $q->execute();

   }


   public function readLocation($locCode) {


         return Doctrine::getTable('Location')->find($locCode);

   }


   public function getCompanyProperty($orderField = "prop_id", $orderBy = "ASC") {

         $q = Doctrine_Query::create()
               ->from('CompanyProperty')
               ->orderBy($orderField . ' ' . $orderBy);

         return $q->execute();

   }


   public function saveCompanyProperty(CompanyProperty $companyProperty) {

         $companyProperty->save();
         return true;

   }


   public function getCompanyPropertyForSupervisor($subordinates, $orderField = "prop_id", $orderBy = "ASC") {

         $q = Doctrine_Query::create()
               ->from('CompanyProperty p')
                   ->where('(p.emp_id IS NULL) OR (p.emp_id = 0)');

         if (!empty($subordinates)) {
            $employeeIds = array();
            foreach($subordinates as $employee) {
               $employeeIds[] = $employee->empNumber;
            }

            $q->orWhereIn('emp_id', $employeeIds);
         }

         $q->orderBy($orderField.' '.$orderBy);
         return $q->execute();

   }

   public function deleteCompanyProperty($propertyList = array()) {

         if(is_array($propertyList)) {
            $q = 	Doctrine_Query::create()
               ->delete('CompanyProperty')
               ->whereIn('prop_id', $propertyList);

            $q->execute();
            return true;
         }

   }


   public function readCompanyProperty($id) {

         $companyProperty = Doctrine::getTable('CompanyProperty')->find($id);
         return $companyProperty;

   }


   function saveCompanyStructure(CompanyStructure $companyStructure)
   {
     
         //this part determines the insert if not update will be performed
         if($companyStructure->getId() == '') {
              
            $idGenService	=	new IDGeneratorService();
            $idGenService->setEntity($companyStructure);            
            $companyStructure->setId($idGenService->getNextID());
         }

         
         $companyStructure->save();
         return true;
     
   }


   function getCompanyStructureList($parentId = null)
   {

         $q = Doctrine_Query::create()
			    ->from('CompanyStructure cs');

         if(!is_null($parentId)) {
            $q->where("parnt = ?", $parentId);
         }

         return $q->execute();


   }
   function getCompanyStructureList1($parentId = null)
   {

         $q = Doctrine_Query::create()
                            ->select('cs.id,cs.title')
			    ->from('CompanyStructure cs');


         return $q->fetchArray();


   }



   function deleteCompanyStructure($id)
   {
   
         $q = Doctrine_Query::create()
            ->delete('CompanyStructure cs')
            ->where("id = ?", $id);
         $q->execute();
         return true;
      
   }


    public function getSubDivisionList() {


	    	$q = Doctrine_query::create()
	    		 ->from('CompanyStructure')
	    		 ->where('id > 1');

	    	$subDivisionList = $q->execute();

	    	return $subDivisionList;



    }


    public function getCompanyDetailsById($id) {
        $q 	= 	Doctrine_Query::create()
                        ->select('s.*,e.*')
                        ->from('CompanyStructure s')
                        ->leftJoin('s.employees e')
                        ->where("s.id =?",array($id));

        return $q->fetchArray();
    }

        public function getCompnayStructure($id) {

            return Doctrine::getTable('CompanyStructure')->find($id);

    }

        public function getEmployee($insList = array()) {


            if (is_array($insList)) {
                $q = Doctrine_Query::create()
                                ->select('e.*')
                                ->from('Employee e')
                                ->whereIn('e.emp_number', $insList);

                return $q->fetchArray();
            }

    }
    public function getEmpRole(){
     $q = Doctrine_Query::create()
                                ->select('e.*')
                                ->from('EmpRoleGroup e');
     return $q->fetchArray();
    }

    public function getLastCompanyStructureTreeID() {
        $q = Doctrine_Query::create()
                        ->select('MAX(r.id)')
                        ->from('CompanyStructure r');
        return $q->fetchArray();
    }

        public function saveCompanyStructureTreeDetails(CompanyStructureDetails $cstdeatil) {

        $cstdeatil->save();

        return true;
    }
       function deleteCompanyStructuredetails($id)
   {

         $q = Doctrine_Query::create()
            ->delete('CompanyStructureDetails csd')
            ->where("csd.id = ?", $id);
         $q->execute();
         return true;

   }
   function getAjaxCompanyStructuredetails($id)
   {

         $q = Doctrine_Query::create()
            ->select('csd.*')
            ->from('CompanyStructureDetails csd')
            ->where("csd.id = ?", $id);
         return $q->execute();


   }

      function getDefLevelDetals($id)
   {

         $q = Doctrine_Query::create()
            ->select('csd.*')
            ->from('CompanyStructureLevels csd')
            ->where("csd.def_level= ?", $id);
         return $q->execute();


   }

         function getCompanystructurehierache()
   {

         $q = Doctrine_Query::create()
            ->select('c.*')
            ->from('CompanyStructure c')
            ->orderBy('c.parnt');
         return $q->execute();


   }
      public function getheadEmployeeListbyID($id){


         $q = Doctrine_Query::create()
                ->from('CompanyStructureDetails')
                ->where("id = ?",array($id));

         return $q->fetchArray();

   }

       public function getRoleIdbyEmpId($empId,$compId){
             $q = Doctrine_Query::create()
                        ->select('h.*')
                        ->from('CompanyStructureDetails h')
                        ->where('h.emp_number = ?',array($empId))
                        ->andwhere('h.id = ?',array($compId));
                return $q->fetchArray();
    }

       public function deleteAllunitHeads($id){
       $q = Doctrine_Query::create()
            ->delete('CompanyStructureDetails h')
            ->where("h.id = ?", array($id));
         $q->execute();
         return true;
   }
   
    public function getHirachyAllList(){
        
        $query="SELECT c.*,e.emp_number FROM hs_hr_compstructtree c LEFT JOIN hs_hr_employee e ON c.emp_number = e.emp_number";

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(Doctrine::FETCH_ASSOC)) {

            $results[] = $row;
        }
        return $results;
    }
    public function getHieHtml($root_id = 0){
                $html  = array();
		$items = $this->getHirachyAllList();
                //print_r($items);die("");

		foreach ( $items as $item )
			$children[$item['parnt']][] = $item;

		// loop will be false if the root has no children (i.e., an empty menu!)
		$loop = !empty( $children[$root_id] );

		// initializing $parent as the root
		$parent = $root_id;
		$parent_stack = array();

               
		
		
                $i=0;
		while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_id ) ) )
		{
                    $html[] = '<tr>';
			if ( $option === false )
			{
				$parent = array_pop( $parent_stack );

				// HTML for menu item containing childrens (close)
				//$html[] = str_repeat( "**", ( count( $parent_stack ) + 1 ) * 2 ) . '</tr>';
				//$html[] = str_repeat( "**", ( count( $parent_stack ) + 1 ) * 2 - 1 ) . '</tr>';
			}
			elseif ( !empty( $children[$option['value']['id']] ) )
			{
				$tab = str_repeat( "**", ( count( $parent_stack ) + 1 ) * 2 - 1 );

				// HTML for menu item containing childrens (open)
                               $url="javascript:void(0);";
            
				$html[] = sprintf(
					'<td>%1$s<a class="qmparent" href="%2$s">%3$s</td>',
					$tab,   // %1$s = tabulation
					"javascript:editCompanyStructure('update', {$option['value']['id']},'edit');"  ,                                      
					$option['value']['title']   // %3$s = title
				);
				//$html[] = $tab . "" . '';

				array_push( $parent_stack, $option['value']['parnt'] );
				$parent = $option['value']['id'];
			}
			else{
                           
				// HTML for menu item with no children (aka "leaf")
                             $html[] = sprintf(
					'<td>%1$s<a href="%2$s">%3$s</a></td>',
					str_repeat( "**", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
					"javascript:editCompanyStructure('update', {$option['value']['id']},'edit');"  ,    
					$option['value']['title']  // %3$s = title
				);
                        }
                        //$html[] = '</td>';
                        $html[] = '</tr>';
                       
		}
                 
                
		// HTML wrapper for the menu (close)
		
                //print_r($html);die;
		return implode( "\r\n", $html );
    }
    public function readDeflevelById($id){
             
            return Doctrine::getTable('EmployeeDefLevel')->find($id);

    }
    public function getValidateHieCode($id,$divisionCode){
       $getCompanyCode=$this->getCompanyId($id);
       
       $currentCompanyCode=$getCompanyCode[0]['comp_code'];
       if($currentCompanyCode!=$divisionCode){

        
       $q = Doctrine_Query::create()
            ->select('e.emp_number')
            ->from('EmployeeMaster e')
            ->where("e.emp_ldap_flag= ?", "1")
            ->andWhere("e.hie_code_1='".$id."' or e.hie_code_2='".$id."' or e.hie_code_3='".$id."' or e.hie_code_4='".$id."' or e.hie_code_5='".$id."' or e.hie_code_6='".$id."' or e.hie_code_7='".$id."'");
            
            
            
        return $q->fetchArray();
       }else{
           return array();
       }
         
    }
    public function getCompanyId($id){
        $q= Doctrine_Query::create()
            ->select('c.comp_code')
            ->from('CompanyStructure c')
            ->where('c.id = ?',array($id));
        return $q->fetchArray();
    }
    
    public function readActingCompanyStructure($Emp,$j){
            $q= Doctrine_Query::create()
            ->select('a.*')
            ->from('EmpActiveWorkstation a')
            ->where('a.emp_number = ?',array($Emp))
            ->andWhere('a.act_workstation_no = ?',array($j));
        return $q->fetchOne();
    }
    
    public function saveActingWorkstation(EmpActiveWorkstation $ActingWorkstation){
        $ActingWorkstation->save();
    }
    
    public function getProvinceList(){
                $q= Doctrine_Query::create()
            ->select('c.*')
            ->from('CompanyStructure c')
            ->where('c.def_level = 2');
        return $q->execute();
    }
    
        public function loadCompanyDataByID($id,$def){
                $q= Doctrine_Query::create()
            ->select('c.*')
            ->from('CompanyStructure c')
            ->where('c.parnt = ?', $id)
            ->andwhere('c.def_level = ?',$def);    
        //return $q->execute();

                return $q->fetchArray();
    }
    
        public function readActingCompanyStructureLoad($Emp){
            $q= Doctrine_Query::create()
            ->select('a.*')
            ->from('EmpActiveWorkstation a')
            ->where('a.emp_number = ?',array($Emp));
        return $q->execute();
    }
    
    public function deleteActingWorkstation($empno,$compId){
          $q = Doctrine_Query::create()
            ->delete('EmpActiveWorkstation a')
            ->where("a.emp_number = ?", $empno)
            ->Andwhere("a.act_workstation_no = ?", $compId);      
         $q->execute();
         return true; 
    }
    public function loadHicStrutByType($searchCategory,$searchMode, $searchValue, $culture="en", $orderField = 'c.id', $orderBy = 'ASC', $page = 1) {
            $sysConf=new sysConf();
// die($searchMode);
                    if ($searchMode == "title") {
                        if ($culture == "en")
                            $feildName = "c.title";
                        else
                            $feildName="c.title_" . $culture;
                    }
                    elseif($searchMode == "id"){
                       
                        $feildName="c.comp_code";
                    }

        if($searchCategory=="0"){

        $res = array();
        
          $sysConf = new sysConf();
        


        $res = array();
        $res['data']=$this->display_children($sysConf->headOfficeCode);
        $res['pglay'] = $pagerLayout;

        return $res;


        }else{
        $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('CompanyStructure c');


         if(strlen($searchCategory)){

             if($searchCategory=="0"){
                  $headOfcPrimaryKey=$this->getHeadOffPK($sysConf->HeadofficeCompCode);
                  $q->where('c.def_level > 3');
                  $q->andWhere('c.parnt= ?',array($headOfcPrimaryKey) );
                  
             }
             else{
//                 die($searchValue);
                    $q->where('def_level = ?',array($searchCategory));

                    if ($searchMode != "all") {
                    $q->andWhere($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
                    }
             }


            
         }else{
        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
         }
        $q->orderBy($orderField . ' ' . $orderBy);
    
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

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
                        "?page={%page_number}&amp;mode=search&amp;txtSearchValue={$searchValue}&cmbSearchMode={$searchMode}&amp;sort={$orderField}&amp;order={$orderBy}&amp;cmbHicCategory={$searchCategory}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
        }
    }

    function getHeadOffPK($comp_code){

         $query = 'SELECT * FROM hs_hr_compstructtree c where comp_code="' . $comp_code . '";';

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch()) {

            $id=$row['id'];

        }
        return $id;
    }
    
    function display_children($parent='') {


        // retrieve all children of $parent
        $query = 'SELECT * FROM hs_hr_compstructtree c LEFT JOIN hs_hr_employee e ON c.emp_number = e.emp_number  WHERE parnt="' . $parent . '";';

        $conn = Doctrine_Manager::getInstance()->connection();
        $stmt = $conn->prepare($query);
        $stmt->execute();


        while ($row = $stmt->fetch()) {
        $this->headOfficeIds[]=$row;

            $this->display_children($row['id']);
        }
        return $this->headOfficeIds;
    }

      public function getUserDefLevel($empID){

         $q= Doctrine_Query::create()
            ->select('u.*')
            ->from('Users u')
            ->where('u.emp_number = ?',array($empID));
            
        return $q->fetchOne();
    }


   public function readCompanyStructurebyTitle($title)
   {

         $q = Doctrine_Query::create()
            ->from('CompanyStructure cs')
            ->where("title = ?", $title);
         if($q->count() == 0) {
            return false;
         }
         return $q->fetchOne();         

   }
}
?>