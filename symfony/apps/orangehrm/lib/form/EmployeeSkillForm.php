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
class EmployeeSkillForm extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'txtSkillCode' => new sfWidgetFormInputHidden(),
            'cmbSkillName' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtSkillYears' => new sfWidgetFormInput(),
            'txtSkillComment' => new sfWidgetFormInput(),
            'txtSkillCommentSI' => new sfWidgetFormInput(),
            'txtSkillCommentTA' => new sfWidgetFormInput(),
        ));

        $this->setValidators(array(
            'txtSkillCode' => new sfValidatorString(array('required' => false)),
            'cmbSkillName' => new sfValidatorString(array('required' => false)),
            'txtSkillYears' => new sfValidatorString(array('required' => false)),
            'txtSkillComment' => new sfValidatorString(array('required' => false)),
            'txtSkillCommentSI' => new sfValidatorString(array('required' => false)),
            'txtSkillCommentTA' => new sfValidatorString(array('required' => false))
        ));
    }

    /**
     * Get employee skill object
     */
    public function getSkill($empNumber,$skillCode) {

        $empSkill = Doctrine::getTable('EmployeeSkill')->find(array('emp_number' => $empNumber,
                                                                      'skill_code' => $skillCode));

        if (is_object($empSkill)==false) {            
            $empSkill = new EmployeeSkill();
            $empSkill->emp_number= $empNumber;
            $empSkill->skill_code= $this->getValue('cmbSkillName');
        }

        $empSkill->eskill_years = $this->getValue('txtSkillYears');
        $empSkill->eskill_comments = $this->getValue('txtSkillComment');
        $empSkill->eskill_comments_si = $this->getValue('txtSkillCommentSI');
        $empSkill->eskill_comments_ta = $this->getValue('txtSkillCommentTA');
        return $empSkill;
    }

}

