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
class EmployeeServiceRecordFrom extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'txtEmpID' => new sfWidgetFormInputHidden(),
            'txtSerRecId' => new sfWidgetFormInputHidden(),
            'txtOffice' => new sfWidgetFormInput(),
            'txtOfficeSi' => new sfWidgetFormInput(),
            'txtOfficeTa' => new sfWidgetFormInput(),
            'txtSDest' => new sfWidgetFormInput(),
            'txtSDestSi' => new sfWidgetFormInput(),
            'txtSDestTa' => new sfWidgetFormInput(),
            'cmbDistrictName' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtSFromDate' => new sfWidgetFormInput(),
            'txtsTodate' => new sfWidgetFormInput(),
        ));

        $this->setValidators(array(
            'txtEmpID' => new sfValidatorNumber(array('required' => true)),
            'txtSerRecId' => new sfValidatorNumber(array('required' => false)),
            'txtOffice' => new sfValidatorString(array('required' => false)),
            'txtOfficeSi' => new sfValidatorString(array('required' => false)),
            'txtOfficeTa' => new sfValidatorString(array('required' => false)),
            'txtSDest' => new sfValidatorString(array('required' => false)),
            'txtSDestSi' => new sfValidatorString(array('required' => false)),
            'txtSDestTa' => new sfValidatorString(array('required' => false)),
            'cmbDistrictName' => new sfValidatorString(array('required' => false)),
            'txtSFromDate' => new sfValidatorString(array('required' => false, 'trim' => true)),
            'txtsTodate' => new sfValidatorString(array('required' => false, 'trim' => true)),
        ));

       
    }

    /**
     * Get employee work experience object
     */
    public function getServiceRecord($empNumber,$eshCode ) {
        

        $serRec = Doctrine::getTable('ServiceHistory')->find(array('esh_code' => $eshCode,'emp_number' => $empNumber));

        if (is_object($serRec) == false) {
            $serRec = new ServiceHistory();
            $serRec->emp_number = $empNumber;
            
        }

        $serRec->esh_name = $this->getValue('txtOffice');
        $serRec->esh_name_si = $this->getValue('txtOfficeSi');
        $serRec->esh_name_ta = $this->getValue('txtOfficeTa');

        $serRec->esh_designation = $this->getValue('txtSDest');
        $serRec->esh_designation_si = $this->getValue('txtSDestSi');
        $serRec->esh_designation_ta = $this->getValue('txtSDestTa');

        $serRec->esh_district = $this->getValue('cmbDistrictName');
        
        if($this->getValue('txtSFromDate')!= null){
        $serRec->esh_from_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtSFromDate'));
        }else{
        $serRec->esh_from_date =null;
        }
        if($this->getValue('txtsTodate')!= null){
        $serRec->esh_to_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtsTodate'));
        }else{
            $serRec->esh_to_date =null;
        }



        return $serRec;
    }

}

