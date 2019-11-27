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
 * Form class for employee job history add
 */
class JobHistoryEditForm extends sfForm {

    const HIST_TYPE_NUM = 3;
    const JOBTITLE_PREFIX = "jobTitle";
    const SUBDIVISION_PREFIX = "subDiv";
    const LOCATION_PREFIX = "loc";

    const ID_SUFFIX = "HisId";
    const CODE_SUFFIX = "HisCode";
    const FROM_SUFFIX = "HisFromDate";
    const TO_SUFFIX = "HisToDate";
    
    private $counts;
    private $prefixes;

    public function configure() {

        $this->counts = array($this->getOption('jobTitleCount', 0),
                        $this->getOption('subDivCount', 0),
                        $this->getOption('locCount', 0));

        $this->prefixes = array(self::JOBTITLE_PREFIX,
                          self::SUBDIVISION_PREFIX,
                          self::LOCATION_PREFIX);

       // Note: Widget names were kept from old non-symfony version
        $this->setWidget('EmpID', new sfWidgetFormInputHidden());
        $this->setValidator('EmpID', new sfValidatorString(array('required' => true)));

        for ($i = 0; $i < self::HIST_TYPE_NUM; $i++) {
            for ($j = 0; $j < $this->counts[$i]; $j++) {

                $index = '{' . $j .  '}';
                $idField = $this->prefixes[$i] . self::ID_SUFFIX . $index;
                $codeField = $this->prefixes[$i] . self::CODE_SUFFIX . $index;
                $fromField = $this->prefixes[$i] . self::FROM_SUFFIX . $index;
                $toField = $this->prefixes[$i] . self::TO_SUFFIX . $index;

                $this->setWidget($idField, new sfWidgetFormInputHidden());
                $this->setWidget($codeField, new sfWidgetFormInput());
                $this->setWidget($fromField, new sfWidgetFormInput());
                $this->setWidget($toField, new sfWidgetFormInput());

                $this->setValidator($idField, new sfValidatorString(array('required' => true)));
                $this->setValidator($codeField, new sfValidatorString(array('required' => true)));
                $this->setValidator($fromField, new sfValidatorString(array('required' => true)));
                $this->setValidator($toField, new sfValidatorString(array('required' => true)));
            }
        }

/*
        $this->validatorSchema->setPostValidator(
            new sfValidatorCallback(array(
              'callback' => array($this, 'postValidate')
            ))
         );
*/
    }


    public function postValidate($validator, $values) {
       
    }


    /**
     * Save employee history item
     */
    public function save() {

    }

}

