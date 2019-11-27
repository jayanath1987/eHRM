<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class JsonFetch{
    public function getEmployeeListAsJson($workShift=false) {
      try {
         $jsonString	=	array();
         $q = Doctrine_Query::create()
             ->from('Employee');

         $employeeList = $q->execute();

         foreach( $employeeList as $employee) {
         	

          //  array_push($jsonString,"{name:'".$employee->getFirstName().' '.$employee->getLastName()."',id:'".$employee->getEmpNumber()."',workShift:'".$workShiftLength."'}");
          array_push($jsonString,"{name:'".$employee->getFirstName().' '.$employee->getLastName()."',id:'".$employee->getEmpNumber()."',companyId:'".$employee->getSubDivision()->getId()."',company:'".$employee->getSubDivision()->getTitle()."'}");
         }

         $jsonStr	=	" [".implode(",",$jsonString)."]";
         
         return $jsonStr;
      } catch(Exception $e) {
         throw new PIMServiceException($e->getMessage());
      }
   }
}
?>
