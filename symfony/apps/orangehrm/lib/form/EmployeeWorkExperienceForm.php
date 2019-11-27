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
class EmployeeWorkExperienceForm extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'txtExpSeqNo' => new sfWidgetFormInputHidden(),
            'txtExpCompanyName' => new sfWidgetFormInput(),
            'txtExpCompanyNameSI' => new sfWidgetFormInput(),
            'txtExpCompanyNameTA' => new sfWidgetFormInput(),
            'txtExpJobTitle' => new sfWidgetFormInput(),
            'txtExpJobTitleSI' => new sfWidgetFormInput(),
            'txtExpJobTitleTA' => new sfWidgetFormInput(),
            'txtExpStartDate' => new sfWidgetFormInput(),
            'txtExpEndDate' => new sfWidgetFormInput(),
            'txtExpComment' => new sfWidgetFormTextarea(),
            'txtExpCommentSI' => new sfWidgetFormTextarea(),
            'txtExpCommentTA' => new sfWidgetFormTextarea()
//            'chkExpInternal' => new sfWidgetFormInput(),

        ));

        $this->setValidators(array(
            'txtExpSeqNo' => new sfValidatorNumber(array('required' => false)),
            'txtExpCompanyName' => new sfValidatorString(array('required' => false)),
            'txtExpCompanyNameSI' => new sfValidatorString(array('required' => false)),
            'txtExpCompanyNameTA' => new sfValidatorString(array('required' => false)),
            'txtExpJobTitle' => new sfValidatorString(array('required' => false)),
            'txtExpJobTitleSI' => new sfValidatorString(array('required' => false)),
            'txtExpJobTitleTA' => new sfValidatorString(array('required' => false)),
            'txtExpStartDate' => new sfValidatorString(array('required' => true, 'trim'=>true)),
            'txtExpEndDate' => new sfValidatorString(array('required' => true, 'trim'=>true)),
            'txtExpComment' => new sfValidatorString(array('required' => false)),
            'txtExpCommentSI' => new sfValidatorString(array('required' => false)),
            'txtExpCommentTA' => new sfValidatorString(array('required' => false))
//            'chkExpInternal' => new sfValidatorString(array('required' => false))
        ));

        // set up your post validator method
        $this->validatorSchema->setPostValidator(
          new sfValidatorCallback(array(
            'callback' => array($this, 'postValidate')
          ))
        );        
    }

    public function postValidate($validator, $values) {

        $fromDate = $values['txtExpStartDate'];
        $toDate = $values['txtExpEndDate'];

        if (!empty($fromDate)) {
            $fromDate = LocaleUtil::getInstance()->convertToStandardDateFormat($fromDate);
            $values['txtExpStartDate'] = $fromDate;
        }

        if (!empty($toDate)) {
            $toDate = LocaleUtil::getInstance()->convertToStandardDateFormat($toDate);
            $values['txtExpEndDate'] = $toDate;
        }

        if (!empty($fromDate) && !empty($toDate)) {
            $fromTime = strtotime($fromDate);
            $toTime = strtotime($toDate);

            if ($fromTime > $toTime) {
                $message = sfContext::getInstance()->getI18N()->__('Start date should be before end date');
                $error = new sfValidatorError($validator, $message);
                throw new sfValidatorErrorSchema($validator, array('' => $error));
            }
        }

        return $values;
    }
    
    /**
     * Get employee work experience object
     */
    public function getWorkExperience($empNumber,$seqNo) {

        $workExp = Doctrine::getTable('EmpWorkExperience')->find(array('emp_number' => $empNumber,
                                                                      'eexp_seqno' => $seqNo));

        if (is_object($workExp)==false) {
            $workExp = new EmpWorkExperience();
            $workExp->emp_number=$empNumber;

            $q = Doctrine_Query::create()
                    ->select('MAX(w.eexp_seqno)')
                    ->from('EmpWorkExperience w')
                    ->where('w.emp_number = ?', $empNumber);
            $result = $q->execute(array(), Doctrine::HYDRATE_ARRAY);

            if (count($result) != 1) {
                throw new PIMServiceException('MAX(seqno) failed.');
            }

            $workExp->eexp_seqno = is_null($result[0]['MAX']) ? 1 : $result[0]['MAX'] + 1;
        }

        $workExp->eexp_company = $this->getValue('txtExpCompanyName');
        $workExp->eexp_company_si = $this->getValue('txtExpCompanyNameSI');
        $workExp->eexp_company_ta = $this->getValue('txtExpCompanyNameTA');

        $workExp->eexp_jobtitle = $this->getValue('txtExpJobTitle');
        $workExp->eexp_jobtitle_si = $this->getValue('txtExpJobTitleSI');
        $workExp->eexp_jobtitle_ta = $this->getValue('txtExpJobTitleTA');

        $workExp->eexp_from_date = $this->getValue('txtExpStartDate');
        $workExp->eexp_to_date = $this->getValue('txtExpEndDate');

        $workExp->eexp_comments = $this->getValue('txtExpComment');
        $workExp->eexp_comments_si = $this->getValue('txtExpCommentSI');
        $workExp->eexp_comments_ta = $this->getValue('txtExpCommentTA');

//        $internal = $this->getValue('chkExpInternal');
//        $workExp->eexp_internal_flg = ($internal==1) ? 1 : 0;

        return $workExp;
    }

}

