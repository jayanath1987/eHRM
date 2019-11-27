<?php

/**
 * Description of ReportService
 *
 * @author poojitha
 */
class ReportService extends BaseService{
	
    private $reportDao;

    /**
    * Retrieve Report List
    * @param String $orderField
    * @param String $orderBy
    * @returns Collection
    */
   public function getReportList($orderField = 'rn_rpt_name', $orderBy = 'ASC') {
        return $this->reportDao->getReportList($orderField, $orderBy);
   }

   /**
    * Search Report
    * @return unknown_type
    */
   public function searchReport( $searchMode, $searchValue, $userCulture="en", $page=1,$orderField = 'm.name', $orderBy = 'ASC', $user)
   {
        return $this->reportDao->searchReport($searchMode, $searchValue, $userCulture, $page, $orderField, $orderBy, $user);
   }  

   /**
    * Read Report
    * @return Report
    */
    public function readReport( $id )
    {
        return $this->reportDao->readReport($id);
    }

    /**
     * Get report details
     * @return Report
     */
    public function getReportById( $id )
    {
        return $this->reportDao->getReportById($id);
    }

	// Included this map incase someone decided to change values
    // Change Value But Don't change Key
    
    public static $REPORT_MAP = array(
            'SEPERATORS' => array(
                'CRITERIA_SEPERATOR' =>  '|',
                'CONDITION_SEPERATOR' => '#'
            ),
            'CONDITIONS' => array(
                'ALL' => 'ALL',
                'EQUALS' => 'EQUALS',
                'BETWEEN' => 'BETWEEN',
                'LESSTHAN' => 'LESSTHAN',
                'GREATERTHAN' => 'GREATERTHAN',
            ),
            # this is selection criteria
            'FIELDS'     => array(
                'EMPNO' => 'EMPNO',
                'AGE' => 'AGE',
                'PAYGRADE' => 'PAYGRADE',
                'EDUCATION' => 'EDUCATION',
                'EMPSTATUS' => 'EMPSTATUS',
                'SERVICEPERI' => 'SERVICEPERI',
                'JOINDATE' => 'JOINDATE',
                'JOBTITLE' => 'JOBTITLE',
                'LANGUAGE' => 'LANGUAGE',
                'SKILLS' => 'SKILLS',
            ),
            #this is select fields
            'SELECT'    => array(
                #Personal
                'EMPNO' => 'EMPNO',
                'FNAME' => 'FNAME',
                'LNAME' => 'LNAME',
                'DOB'   => 'DOB',
                #contact
                'ADDRESS'   => 'ADDRESS',
                'TELNO'     => 'TELNO',
                #job
                'JOBTIT'    => 'JOBTIT',
                'JOINDATE'  => 'JOINDATE',
                'SUBDIV'    => 'SUBDIV',
                'EMPSTAT'   => 'EMPSTAT',
                'CONTRACT'  => 'CONTRACT',
                #salary
                'PAYGRD'  => 'PAYGRD',
                #report to
                'REPORTTO'  => 'REPORTTO',
                'REPMETHOD'  => 'REPMETHOD',
                #workexperience
                'WRKEXP'  => 'WRKEXP',
                #education
                'QUALI'     => 'QUALI',
                'YEAROFPASS'=> 'YEAROFPASS',
                #languages
                'LANG'     => 'LANG',
                #skill
                'SKILL'     => 'SKILL',
            )

    );
	
	public function __construct() {
		$this->reportDao = new ReportDao();
	}
	
	public function setReportDao(ReportDao  $reportDao = null ) {
		if( $reportServiceDao != null) {
			$this->reportDao = $reportServiceDao;
		} else {
			$this->reportDao = new ReportDao();
		}		
	}

	public function getReportDao() {
		return $this->reportDao;
	}

    public function getReportFromID($repId) {
        return $this->reportDao->getReportFromID($repId);
    }
    /*
     * Get the ID's of the groups a report is assigned
     */
    public function getReportGroupsFromID($repId) {
        return $this->reportDao->getReportGroupsFromID($repId);
    }
    /*
     * Returns report IDs when passed group ID
     */
    public function getReportsFromUserGroup($groupId) {
        return $this->reportDao->getReportsFromUserGroup($groupId);
    }
    public function getEmployeeFromID($empId) {
        return $this->reportDao->getEmployeeFromID($empId);
    }
	public function getReportDefnitions ($id = null) {
		return $this->reportDao->getReportDefnitions($id);
	}

    /**
     *
	 * count the number of reports and returns the value
	 * @return integer
	 */
    public function getReportListCount($filters, $orderField, $orderBy, $reportIds = null){
	
        if($orderField == '' || $orderField == null) {
            $orderField = 'reportName';
        }

        if($orderBy == '' || $orderBy == null) {
            $orderBy = 'ASC';
        }

        return $this->reportDao->getReportListCount($filters,$orderField,$orderBy,$reportIds);
    }
	

    public function deleteReports($locationCodeList ) {
    	
        return $this->reportDao->deleteReports($locationCodeList );
    }

    public function deleteReportGroups($reportID) {
        return $this->reportDao->deleteReportGroups($reportID);
    }
    /**
	 * save the reports which are assigned to given groupIds
     *  $groups = array(1=>'GRP001',2=>'GRP002')
     * * @return true
	 */
    public function saveReportGroups( $reportId, $groups) {
       return $this->reportDao->saveReportGroups( $reportId, $groups);
        
    }

     public function saveReport(EmployeeReport $employeeReport) {
         return $this->reportDao->saveReport($employeeReport);          
    }


    
	public function getTableIdentifiers($fields, $conditions, $identiferVsFields){
		
		$idnntifers = array();	
		
		$fielsArray = explode("|", $fields);
		foreach($fielsArray as $field) {
			if(array_key_exists( $field, $identiferVsFields)) {				
				$idnntifers [] = $identiferVsFields[$field];
			}
		}

		$fielsArray = explode("|", $conditions);

		foreach($fielsArray as $field) {
			$field = explode("#",$field);
			$field = $field [0];
			if(array_key_exists( $field, $identiferVsFields)) {
				$idnntifers [] = $identiferVsFields[$field];
			}
		}
		
		return array_unique($idnntifers);		
	}
	
	public function getReportDataCount ($reportFields, $conditions){	
		return $this->getDecoratedReport($reportFields, $conditions, null, true)->getCount();		
	}
    
	
    public function editReport($repId,$repName,$criteriaList,$fieldList) {
        return $this->reportDao->editReport($repId,$repName,$criteriaList,$fieldList);
    }
}
?>
