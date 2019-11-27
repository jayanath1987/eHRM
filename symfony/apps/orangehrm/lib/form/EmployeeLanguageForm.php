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
class EmployeeLanguageForm extends sfForm {

    public function configure() {

        $fluencyTypes  = array (EmployeeLanguage::FLUENCY_WRITING,
                                EmployeeLanguage::FLUENCY_SPEAKING,
                                EmployeeLanguage::FLUENCY_READING);

        $competencyTypes = array(EmployeeLanguage::COMPETENCY_POOR,
                                 EmployeeLanguage::COMPETENCE_BASIC,
                                 EmployeeLanguage::COMPETENCE_GOOD,
                                 EmployeeLanguage::COMPETENCY_MOTHER_TONGUE);

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'txtLanCode' => new sfWidgetFormInputHidden(),
            'txtLanType' => new sfWidgetFormInputHidden(),
            'cmbLanName' => new sfWidgetFormSelect(array('choices'=>array())),
            'cmbLanFluency' => new sfWidgetFormSelect(array('choices'=>array())),
            'cmbLanCompetency' => new sfWidgetFormSelect(array('choices'=>array())),
        ));

        $this->setValidators(array(
            'txtLanCode' => new sfValidatorString(array('required' => false)),
            'txtLanType' => new sfValidatorString(array('required' => false)),
            'cmbLanName' => new sfValidatorString(array('required' => false)),
            'cmbLanFluency' => new sfValidatorString(array('required' => false)),
            'cmbLanCompetency' => new sfValidatorString(array('required' => false))
        ));
    }

    /**
     * Get employee language object
     */
    public function getEmpLanguage($empNumber,$langCode,$langType) {

        $empLanguage = Doctrine::getTable('EmployeeLanguage')->find(array('emp_number' => $empNumber,
                                                                      'lang_code' => $langCode,
                                                                      'emplang_type' => $langType));
        
        if (is_object($empLanguage)==false) {
            $empLanguage = new EmployeeLanguage();
            $empLanguage->emp_number= $empNumber;
            $empLanguage->lang_code= $this->getValue('cmbLanName');
            $empLanguage->emplang_type= $this->getValue('cmbLanFluency');
        }
        
        $empLanguage->emplang_competency = $this->getValue('cmbLanCompetency');
        return $empLanguage;
    }

}

