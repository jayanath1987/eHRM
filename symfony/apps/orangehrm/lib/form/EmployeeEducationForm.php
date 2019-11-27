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
require_once ROOT_PATH . '/lib/common/LocaleUtil.php';
/**
 * Form class for employee contact detail
 */
class EmployeeEducationForm extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'txtEduCode' => new sfWidgetFormInputHidden(),
            'cmbEduName' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtEduInstitute' => new sfWidgetFormInput(),
            'txtEduInstituteSI' => new sfWidgetFormInput(),
            'txtEduInstituteTA' => new sfWidgetFormInput(),
            'txtEduStream' => new sfWidgetFormInput(),
            'txtEduStreamSI' => new sfWidgetFormInput(),
            'txtEduStreamTA' => new sfWidgetFormInput(),
            'txtEduStartDate' => new sfWidgetFormInput(),
            'txtEduEndDate' => new sfWidgetFormInput(),
            'txtEduIndex' => new sfWidgetFormInput(),
            'chkEduConfirmed' => new sfWidgetFormInput(),
        ));

        $this->setValidators(array(
            'txtEduCode' => new sfValidatorString(array('required' => false)),
            'cmbEduName' => new sfValidatorString(array('required' => false)),
            'txtEduInstitute' => new sfValidatorString(array('required' => false,'trim'=>true)),
            'txtEduInstituteSI' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtEduInstituteTA' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtEduStream' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtEduStreamSI' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtEduStreamTA' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtEduStartDate' => new sfValidatorString(array('required' => false)),
            'txtEduEndDate' => new sfValidatorString(array('required' => true)),
            'txtEduIndex' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'chkEduConfirmed' => new sfValidatorString(array('required' => false))
        ));
    }

    /**
     * Get employee education object
     */
    public function getEducation($empNumber,$eduCode) {

        $empEducation = Doctrine::getTable('EmployeeEducation')->find(array('emp_number' => $empNumber,
                                                                      'edu_code' => $eduCode));

        if (is_object($empEducation)==false) {            
            $empEducation = new EmployeeEducation();
            $empEducation->emp_number= $empNumber;
            $empEducation->edu_code= $this->getValue('cmbEduName');
        }

        $empEducation->edu_institute = $this->getValue('txtEduInstitute');
        $empEducation->edu_institute_si = $this->getValue('txtEduInstituteSI');
        $empEducation->edu_institute_ta = $this->getValue('txtEduInstituteTA');
        $empEducation->edu_stream = $this->getValue('txtEduStream');
        $empEducation->edu_stream_si = $this->getValue('txtEduStreamSI');
        $empEducation->edu_stream_ta = $this->getValue('txtEduStreamTA');
        $empEducation->edu_index_no = $this->getValue('txtEduIndex');
        if($this->getValue('txtEduStartDate')!= null){
        $empEducation->edu_start_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtEduStartDate'));
        }else{
           $empEducation->edu_start_date =null;
        }
        if($this->getValue('txtEduEndDate')!= null){
        $empEducation->edu_end_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtEduEndDate'));
        }else{
            $empEducation->edu_end_date =null;
        }
        $confirmed = $this->getValue('chkEduConfirmed');
        $empEducation->edu_confirmed_flg = ($confirmed==1) ? 1 : 0;
        
        return $empEducation;
    }

}

