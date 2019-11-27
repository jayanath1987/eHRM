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
class EmployeeLicenseForm extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'txtLicSeqNo' => new sfWidgetFormInputHidden(),
            'txtLicNumber' => new sfWidgetFormInput(),
            'txtLicType' => new sfWidgetFormInput(),
            'txtLicTypeSI' => new sfWidgetFormInput(),
            'txtLicTypeTA' => new sfWidgetFormInput(),
            'txtLicIssueDate' => new sfWidgetFormInput(),
            'txtLicExpiryDate' => new sfWidgetFormInput(),
        ));

        $this->setValidators(array(
            'txtLicSeqNo' => new sfValidatorNumber(array('required' => false)),
            'txtLicNumber' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtLicType' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtLicTypeSI' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtLicTypeTA' => new sfValidatorString(array('required' => false, 'trim'=>true)),
            'txtLicIssueDate' => new sfValidatorString(array('required' => true, 'trim'=>true)),
            'txtLicExpiryDate' => new sfValidatorString(array('required' => false, 'trim'=>true))
        ));
    }

    /**
     * Get employee license object
     */
    public function getLicense($empNumber,$seqNo) {

        $empLicense = Doctrine::getTable('EmployeeLicense')->find(array('emp_number' => $empNumber,
                                                                      'lic_seqno' => $seqNo));

        if (is_object($empLicense)==false) {
            $empLicense = new EmployeeLicense();
            $empLicense->emp_number=$empNumber;

            $q = Doctrine_Query::create()
                    ->select('MAX(l.lic_seqno)')
                    ->from('EmployeeLicense l')
                    ->where('l.emp_number = ?', $empNumber);
            $result = $q->execute(array(), Doctrine::HYDRATE_ARRAY);

            if (count($result) != 1) {
                throw new PIMServiceException('MAX(seqno) failed.');
            }

            $empLicense->lic_seqno = is_null($result[0]['MAX']) ? 1 : $result[0]['MAX'] + 1;
        }

        $empLicense->lic_number = $this->getValue('txtLicNumber');
        $empLicense->lic_type = $this->getValue('txtLicType');
        $empLicense->lic_type_si = $this->getValue('txtLicTypeSI');
        $empLicense->lic_type_ta = $this->getValue('txtLicTypeTA');

        $empLicense->lic_issue_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtLicIssueDate'));

        if($this->getValue('txtLicExpiryDate')!= ""){
            $empLicense->lic_expiry_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtLicExpiryDate'));
        }else{
            $empLicense->lic_expiry_date = null;
        }
        

        return $empLicense;
    }
}

