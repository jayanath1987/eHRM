<?php
/*
// OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
// all the essential functionalities required for any enterprise.
// Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com

// OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
// the GNU General Public License as published by the Free Software Foundation; either
// version 2 of the License, or (at your option) any later version.

// OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
// without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU General Public License for more details.

// You should have received a copy of the GNU General Public License along with this program;
// if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
// Boston, MA  02110-1301, USA
*/

require_once ROOT_PATH . '/lib/confs/Conf.php';
require_once ROOT_PATH . '/lib/dao/DMLFunctions.php';
require_once ROOT_PATH . '/lib/dao/SQLQBuilder.php';

class Login {

		var $username;
		var $password;
		var $employeeIdLength;

		function Login() {
			$tmpSysConf = new sysConf();

			$this->employeeIdLength = $tmpSysConf->getEmployeeIdLength();
		}

function filterUser($userName) {
			$sql_builder = new SQLQBuilder();
			$dbConnection = new DMLFunctions();

			$this->username=mysql_real_escape_string($userName);
			$tableName = 'HS_HR_USERS a LEFT JOIN HS_HR_EMPLOYEE b ON (a.EMP_NUMBER = b.EMP_NUMBER) LEFT JOIN hs_hr_sm_capability m ON (a.sm_capability_id=m.sm_capability_id)';
			$arrFieldList[0] = 'a.USER_NAME';
			$arrFieldList[1] = 'a.USER_PASSWORD';
			$arrFieldList[2] = 'IFNULL(b.EMP_FIRSTNAME, a.USER_NAME)';
			$arrFieldList[3] = 'a.ID';
			$arrFieldList[4] = 'a.USERG_ID';
			$arrFieldList[5] = 'a.STATUS';
			$arrFieldList[6] = 'LPAD(a.`EMP_NUMBER`, '.$this->employeeIdLength.', 0)';
			$arrFieldList[7] = 'a.IS_ADMIN';
			$arrFieldList[8] = 'b.EMP_STATUS';
			$arrFieldList[9] = 'a.EMP_NUMBER';
                        $arrFieldList[10] = 'a.sm_capability_id';
                        $arrFieldList[11] = 'a.user_prefered_language';
                        /*todo get employee name reading database*/
                        $arrFieldList[12] = 'b.emp_firstname';
                        $arrFieldList[13] = 'b.emp_firstname_si';
                        $arrFieldList[14] = 'b.emp_firstname_ta';
                        $arrFieldList[15] = 'm.sm_capability_enable_flag';

			$sql_builder->table_name = $tableName;
			$sql_builder->flg_select = 'true';
			$sql_builder->arr_select = $arrFieldList;

			$sqlQString = $sql_builder->selectOneRecordFiltered($this->username);

			//echo $sqlQString;
			$message2 = $dbConnection -> executeQuery($sqlQString); //Calling the addData() function

			if ( ($message2) && (mysql_num_rows($message2)!=0) ) {
				$i=0;
				while ($line = mysql_fetch_array($message2, MYSQL_NUM)) {

					$arrayDispList[$i][0] = $line[0];
					$arrayDispList[$i][1] = $line[1];
					$arrayDispList[$i][2] = $line[2];
					$arrayDispList[$i][3] = $line[3];
					$arrayDispList[$i][4] = $line[4];
					$arrayDispList[$i][5] = $line[5];
					$arrayDispList[$i][6] = $line[6];
					$arrayDispList[$i][7] = $line[7];
					$arrayDispList[$i][8] = $line[8];
					$arrayDispList[$i][9] = $line[9];
                                        $arrayDispList[$i][10] = $line[10];
                                        $arrayDispList[$i][11] = $line[11];
                                        $arrayDispList[$i][12] = $line[12];
                                        $arrayDispList[$i][13] = $line[13];
                                        $arrayDispList[$i][14] = $line[14];
                                        $arrayDispList[$i][15] = $line[15];
					$i++;
				}
			return $arrayDispList;

			 } else return NULL;
			}

             function filterMenus($capaId){
                 $sql_builder = new SQLQBuilder();
			$dbConnection = new DMLFunctions();

			

			//$sqlQString = "select m.sm_mnuitem_webpage_url from hs_hr_sm_mnuitem m left join hs_hr_sm_mnucapability c on m.sm_mnuitem_id=c.sm_mnuitem_id left join hs_hr_users u on u.sm_capability_id=c.sm_capability_id where u.id='".$_SESSION['user']."'";
                        if($_SESSION['user']=="USR001"){
                $query="SELECT m.sm_mnuitem_webpage_url,m.sm_mnuitem_dependency FROM hs_hr_sm_mnuitem m ORDER BY sm_mnuitem_parent, sm_mnuitem_position;";
                }
                else{
                    $query="select m.sm_mnuitem_webpage_url,m.sm_mnuitem_dependency from hs_hr_sm_mnuitem m left join hs_hr_sm_mnucapability c on m.sm_mnuitem_id=c.sm_mnuitem_id left join hs_hr_users u on u.sm_capability_id=c.sm_capability_id where u.id='".$_SESSION['user']."' ORDER BY m.sm_mnuitem_parent, m.sm_mnuitem_position ASC;";
                }
			//echo $sqlQString;
			$message2 = $dbConnection -> executeQuery($query); //Calling the addData() function

			if ( ($message2) && (mysql_num_rows($message2)!=0) ) {
				$i=0;
				$assoc_all = array();

		while( $fetch = mysql_fetch_assoc( $message2  ) ){
			$assoc_all[] = $fetch;
                }
                //print_r($assoc_all);die;
			return $assoc_all;

			 } else return NULL;
             }

          function getMenus($id){
             
                        $sql_builder = new SQLQBuilder();
			$dbConnection = new DMLFunctions();
                        $menuId=mysql_real_escape_string($id);

                        ///$sqlQString = $sql_builder->selectOneRecordFiltered($menuId);
                        //$sqlQString = $sql_builder->simpleSelect();
                        $sqlQString="select * from hs_hr_sm_mnuitem i where i.sm_mnuitem_parent=$id";

                        $message2 = $dbConnection -> executeQuery($sqlQString); //Calling the addData() function

			if ( ($message2) && (mysql_num_rows($message2)!=0) ) {
				$i=0;
				while ($line = mysql_fetch_array($message2, MYSQL_NUM)) {

					$arrayDispList[0] = $line[0];
					$arrayDispList[1] = $line[1];
					$arrayDispList[2] = $line[2];
					$arrayDispList[3] = $line[3];
					$arrayDispList[4] = $line[4];
					$arrayDispList[5] = $line[5];
					$arrayDispList[6] = $line[6];
					$arrayDispList[7] = $line[7];
					$arrayDispList[8] = $line[8];
					//$arrayDispList[9] = $line[9];
					$i++;
				}
			return $arrayDispList;

			 } else return NULL;
          }
          function getCompanyRoot(){
              
                        $sql_builder = new SQLQBuilder();
			$dbConnection = new DMLFunctions();
                                              
                        $sqlQString="select i.title,i.title_si,i.title_ta from hs_hr_compstructtree i where i.id=1";

                        $message2 = $dbConnection -> executeQuery($sqlQString); //Calling the addData() function

			if ( ($message2) && (mysql_num_rows($message2)!=0) ) {
				$i=0;
				while ($line = mysql_fetch_array($message2, MYSQL_NUM)) {

					$arrayDispList[0] = $line[0];
					$arrayDispList[1] = $line[1];
                                        $arrayDispList[2] = $line[2];
					
					//$arrayDispList[9] = $line[9];
					$i++;
				}
			return $arrayDispList;

			 } else return NULL;
          }
}
?>