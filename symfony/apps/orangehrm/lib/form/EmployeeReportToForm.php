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

/**
 * Form class for employee dependent
 */
class EmployeeReportToForm extends sfForm {

    const SUPERVISOR = 'Supervisor';
    const SUBORDINATE = 'Subordinate';

    public function configure() {


        $reportTypeOptions = array(self::SUPERVISOR, self::SUBORDINATE);
        $reportMethodOptions = array(ReportTo::DIRECT, ReportTo::INDIRECT);

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'EmpID' => new sfWidgetFormInputHidden(),
            'txtSupEmpID' => new sfWidgetFormInputHidden(), // old supervisor
            'txtSubEmpID' => new sfWidgetFormInputHidden(), // old subordinate
			'oldRepMethod' => new sfWidgetFormInputHidden(), // old reporting method
			'cmbRepType' => new sfWidgetFormChoice(array('choices'=>array())),
			'cmbRepEmpID' => new sfWidgetFormInput(), // Employee name
            'txtRepEmpID' => new sfWidgetFormInputHidden(), // Employee number
            'cmbRepMethod' => new sfWidgetFormChoice(array('choices'=>array())), // Reporting method
        ));

        $this->setValidators(array(
            'EmpID' => new sfValidatorInteger(array('required' => true, 'min'=> 0)),
            'txtSupEmpID' => new sfValidatorInteger(array('required' => false, 'min'=> 0)),
            'txtSubEmpID' => new sfValidatorInteger(array('required' => false, 'min' => 0)),
            'oldRepMethod' => new sfValidatorChoice(array('required' => false, 'choices' => $reportMethodOptions)),
            'cmbRepType' => new sfValidatorChoice(array('required' => true,
                                                  'choices' => $reportTypeOptions)),
            'cmbRepEmpID' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtRepEmpID' => new sfValidatorInteger(array('required' => true, 'trim'=>true, 'min' => 0)),
            'cmbRepMethod' => new sfValidatorChoice(array('required' => true,
                                                  'choices' => $reportMethodOptions)),

        ));

//        // set up your post validator method
//        $this->validatorSchema->setPostValidator(
//          new sfValidatorCallback(array(
//            'callback' => array($this, 'postValidate')
//          ))
//        );
    }

    public function postValidate($validator, $values) {

        // Verify EmpID matches one of old supervisor/subordinate
        $empNumber = $values['EmpID'];
//            die(print_r($empNumber));
        $oldSupervisorId = $values['txtSupEmpID'];
        
        $oldSubordinateId = $values['txtSubEmpID'];

        // NOTE: This is not a user error
        if (!empty($oldSupervisorId) && !empty($oldSubordinateId)) {
            if ( ($empNumber != $oldSupervisorId) && ($empNumber != $oldSubordinateId) ) {
                $message = sfContext::getInstance()->getI18N()->__('Invalid input');
                $error = new sfValidatorError($validator, $message);
                throw new sfValidatorErrorSchema($validator, array('' => $error));
            }
        }

        // Verify EmpID does not match new supervisor/subordinate
        $otherEmpId = $values['txtRepEmpID'];


       

        if ($otherEmpId === $empNumber) {

        throw new Exception("duplicate",10);
           

//            $message = sfContext::getInstance()->getI18N()->__('You can not add yourself as a supervisor to you');
//            $error = new sfValidatorError($validator, $message);
//            throw new sfValidatorErrorSchema($validator, array('cmbRepEmpID' => $error));
        } 
        $empDao=new EmployeeDao();
        //$assignReportto=$empDao->getReportsTo();

        return $values;

    }

    /**
     * Save employee report to
     */
    public function save() {

        $empNumber = $this->getValue('EmpID');
        $oldSupervisorId = $this->getValue('txtSupEmpID');
        $oldSubordinateId = $this->getValue('txtSubEmpID');
        $oldReportingMode = $this->getValue('oldRepMethod');

		$reportingType = $this->getValue('cmbRepType');
        $otherEmpId = $this->getValue('txtRepEmpID');
        $method = $this->getValue('cmbRepMethod');

        if ($reportingType == self::SUPERVISOR) {
            $supervisor = $otherEmpId;
            $subordinate = $empNumber;
        } else {
            $supervisor = $empNumber;
            $subordinate = $otherEmpId;
        }

        $reportTo = false;

        if (!empty($oldSupervisorId) && !empty($oldSubordinateId)
                && !empty($oldReportingMode)) {

            $reportTo = Doctrine::getTable('ReportTo')
                      ->find(array('supervisorId' => $oldSupervisorId,
                                   'subordinateId' => $oldSubordinateId,
                                   'reportingMode' => $oldReportingMode));
        }

        if ($reportTo === false) {
            $reportTo = new ReportTo();
        }

        $reportTo->supervisorId = $supervisor;
        $reportTo->subordinateId = $subordinate;
        $reportTo->reportingMode = $method;

        try {
            $reportTo->save();
        } catch(Doctrine_Connection_Mysql_Exception $e) {
           throw new DataDuplicationException($e->getMessage() . " - Saving failed due Employee reporting already exists no need of insertion again");
        }
    }

}

