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
 * Form class for employee personal details
 */
require_once ROOT_PATH . '/lib/common/LocaleUtil.php';

class EmployeePersonalDetailsForm extends sfForm {

    public function configure() {

        $ess = $this->getOption('ESS', false);
        
        $this->setWidgets(array(
            'txtEmpID' => new sfWidgetFormInputHidden(),
            'txtEmployeeId' => new sfWidgetFormInput(),
            'txtAppLetterNo' => new sfWidgetFormInput(),
            'txtPersonalFileNo' => new sfWidgetFormInput(),
            'cmbTitle' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtEmpLastName' => new sfWidgetFormInput(),
            'txtEmpLastNameSI' => new sfWidgetFormInput(),
            'txtEmpLastNameTA' => new sfWidgetFormInput(),
            'txtEmpFirstName' => new sfWidgetFormInput(),
            'txtEmpFirstNameSI' => new sfWidgetFormInput(),
            'txtEmpFirstNameTA' => new sfWidgetFormInput(),
	    'txtInitials' => new sfWidgetFormInput(),
            'txtInitialsSI' => new sfWidgetFormInput(),
            'txtInitialsTA' => new sfWidgetFormInput(),
            'txtNamesOfInitials' => new sfWidgetFormInput(),
            'txtNamesOfInitialsSI' => new sfWidgetFormInput(),
            'txtNamesOfInitialsTA' => new sfWidgetFormInput(),
            'cmbGender' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtDOB' => new sfWidgetFormInput(),
            'txtPlaceOfBirth' => new sfWidgetFormInput(),
            'txtPlaceOfBirthSI' => new sfWidgetFormInput(),
            'txtPlaceOfBirthTA' => new sfWidgetFormInput(),
            'cmbMaritalStatus' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtMarriedDate' => new sfWidgetFormInput(),
            'txtNICNo' => new sfWidgetFormInput(),
            'txtNICIssueDate' => new sfWidgetFormInput(),
            'txtPassportNo' => new sfWidgetFormInput(),            
            'cmbEthnicity' => new sfWidgetFormSelect(array('choices'=>array())),
            'cmbReligion' => new sfWidgetFormSelect(array('choices'=>array())),
            'cmbLanguage' => new sfWidgetFormSelect(array('choices'=>array())),
            'cmbNationality' => new sfWidgetFormSelect(array('choices'=>array())),
            'cmbCountry' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtAttendanceNo' => new sfWidgetFormInput(),
            'txtSalaryNo' => new sfWidgetFormInput(),
            'txtRunningFileNo' => new sfWidgetFormInput(),
            'txtBarCodeNo' => new sfWidgetFormInput(),
            'txtPensionNo' => new sfWidgetFormInput(),
        ));

        // Widgets for non-ess mode only
        if (!$ess) {
        }

        $this->setValidators(array(
            'txtEmpID' => new sfValidatorString(array('required' => true)),
            'txtEmployeeId' => new sfValidatorString(array('required' => false)),
            'txtAppLetterNo' => new sfValidatorString(array('required' => false)),
            'txtPersonalFileNo' => new sfValidatorString(array('required' => false)),
            'cmbTitle' => new sfValidatorString(array('required' => false)),
            'txtEmpLastName' => new sfValidatorString(array('required' => false)),
            'txtEmpLastNameSI' => new sfValidatorString(array('required' => false)),
            'txtEmpLastNameTA' => new sfValidatorString(array('required' => false)),
            'txtEmpFirstName' => new sfValidatorString(array('required' => false)),
            'txtEmpFirstNameSI' => new sfValidatorString(array('required' => false)),
            'txtEmpFirstNameTA' => new sfValidatorString(array('required' => false)),
	    'txtInitials' => new sfValidatorString(array('required' => false)),
            'txtInitialsSI' => new sfValidatorString(array('required' => false)),
            'txtInitialsTA' => new sfValidatorString(array('required' => false)),
            'txtNamesOfInitials' => new sfValidatorString(array('required' => false)),
            'txtNamesOfInitialsSI' => new sfValidatorString(array('required' => false)),
            'txtNamesOfInitialsTA' => new sfValidatorString(array('required' => false)),
            'cmbGender' => new sfValidatorString(array('required' => false)),
            'txtDOB' => new sfValidatorString(array('required' => false)),
            'txtPlaceOfBirth' => new sfValidatorString(array('required' => false)),
            'txtPlaceOfBirthSI' => new sfValidatorString(array('required' => false)),
            'txtPlaceOfBirthTA' => new sfValidatorString(array('required' => false)),
            'cmbMaritalStatus' => new sfValidatorString(array('required' => false)),
            'txtMarriedDate' => new sfValidatorString(array('required' => false)),
            'txtNICNo' => new sfValidatorString(array('required' => false)),
            'txtNICIssueDate' => new sfValidatorString(array('required' => false)),
            'txtPassportNo' => new sfValidatorString(array('required' => false)),
            'cmbEthnicity' => new sfValidatorString(array('required' => false)),
            'cmbReligion' => new sfValidatorString(array('required' => false)),
            'cmbLanguage' => new sfValidatorString(array('required' => false)),
            'cmbNationality' => new sfValidatorString(array('required' => false)),
            'cmbCountry' => new sfValidatorString(array('required' => false)),
            'txtAttendanceNo' => new sfValidatorString(array('required' => false)),
            'txtSalaryNo' => new sfValidatorString(array('required' => false)),
            'txtRunningFileNo' => new sfValidatorString(array('required' => false)),
            'txtBarCodeNo' => new sfValidatorString(array('required' => false)),
            'txtPensionNo' => new sfValidatorString(array('required' => false)),
        ));
    }

    /**
     * Get Employee object with values filled using form values
     */
    public function getEmployee() {
        $ess = $this->getOption('ESS', false);

        $employee = Doctrine::getTable('EmployeeMaster')->find($this->getValue('txtEmpID'));
        
        if (is_object($employee)==false) {
            throw new PIMServiceException();            
        }
        
        $employee->employeeId = trim($this->getValue('txtEmployeeId'));
        $employee->emp_app_letter_no = trim($this->getValue('txtAppLetterNo'));
        $employee->emp_personal_file_no = trim($this->getValue('txtPersonalFileNo'));

        $title = $this->getValue('cmbTitle');
        $employee->title_code = ($title != '0') ? $title : null;
        
        $employee->lastName = trim($this->getValue('txtEmpLastName'));
        $employee->lastName_si = trim($this->getValue('txtEmpLastNameSI'));
        $employee->lastName_ta = trim($this->getValue('txtEmpLastNameTA'));

        $employee->firstName = trim($this->getValue('txtEmpFirstName'));
        $employee->firstName_si = trim($this->getValue('txtEmpFirstNameSI'));
        $employee->firstName_ta = trim($this->getValue('txtEmpFirstNameTA'));

        $employee->emp_display_name = trim($this->getValue('txtEmpFirstName') . ' ' . $this->getValue('txtEmpLastName'));
        $employee->emp_display_name_si = trim($this->getValue('txtEmpFirstNameSI') . ' ' . $this->getValue('txtEmpLastNameSI'));
        $employee->emp_display_name_ta = trim($this->getValue('txtEmpFirstNameTA') . ' ' . $this->getValue('txtEmpLastNameTA'));

        $employee->emp_initials = $this->getValue('txtInitials');
        $employee->emp_initials_si = $this->getValue('txtInitialsSI');
        $employee->emp_initials_ta = $this->getValue('txtInitialsTA');

        $employee->emp_names_of_initials = $this->getValue('txtNamesOfInitials');
        $employee->emp_names_of_initials_si = $this->getValue('txtNamesOfInitialsSI');
        $employee->emp_names_of_initials_ta = $this->getValue('txtNamesOfInitialsTA');

        $gender = $this->getValue('cmbGender');
        $employee->gender_code = ($gender != '0') ? $gender : null;

        $employee->emp_birthday = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtDOB'));
        $employee->emp_birth_location = $this->getValue('txtPlaceOfBirth');
        $employee->emp_birth_location_si = $this->getValue('txtPlaceOfBirthSI');
        $employee->emp_birth_location_ta = $this->getValue('txtPlaceOfBirthTA');

        $maritalStatus = $this->getValue('cmbMaritalStatus');
        $employee->marst_code = ($maritalStatus != '0') ? $maritalStatus : null;

 if($this->getValue('txtMarriedDate')==null){
     $employee->emp_married_date=null;
 }
 else{
            $employee->emp_married_date=LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtMarriedDate'));
 }

        $employee->emp_nic_no = $this->getValue('txtNICNo');
        $employee->emp_nic_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtNICIssueDate'));

        $employee->emp_passport_no = $this->getValue('txtPassportNo');
        
        //$ethnicity = $this->getValue('cmbEthnicity');
        //$employee->ethnic_race_code = ($ethnicity != '0') ? $ethnicity : null;
        $employee->ethnic_race_code = null;

        $religion = $this->getValue('cmbReligion');

        $employee->rlg_code = ($religion != null) ? $religion : null;

        $language = $this->getValue('cmbLanguage');
        $employee->lang_code = ($language != '0') ? $language : null;

        $nationality = $this->getValue('cmbNationality');
        $employee->nation_code = ($nationality != '0') ? $nationality : null;

        $country = $this->getValue('cmbCountry');
        $employee->cou_code = ($country != '0') ? $country : null;

        //$employee->emp_attendance_no = $this->getValue('txtAttendanceNo');
        $employee->emp_salary_no = $this->getValue('txtSalaryNo');
        $employee->emp_other_file_no = $this->getValue('txtRunningFileNo');
        $employee->emp_barcode_no = $this->getValue('txtBarCodeNo');

        $pensionNo=$this->getValue('txtPensionNo');
        
        $employee->emp_pension_no = ($pensionNo == '') ? null : $pensionNo;
                
        return $employee;       
    }

}

