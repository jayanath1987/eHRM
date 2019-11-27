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
class EmployeeDependentForm extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'txtDepSeqNo' => new sfWidgetFormInput(),
            'txtDepName' => new sfWidgetFormInput(),
            'txtDepNameSI' => new sfWidgetFormInput(),
            'txtDepNameTA' => new sfWidgetFormInput(),
            'cmbDepRelationship' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtDepDOB' => new sfWidgetFormInput(),
            'txtDepWorkplace' => new sfWidgetFormInput(),
            'txtDepWorkplaceSI' => new sfWidgetFormInput(),
            'txtDepWorkplaceTA' => new sfWidgetFormInput(),
            'txtDepEduCenter' => new sfWidgetFormInput(),
            'txtDepEduCenterSI' => new sfWidgetFormInput(),
            'txtDepEduCenterTA' => new sfWidgetFormInput(),
            'txtDepAddress' => new sfWidgetFormInput(),
            'txtDepAddressSI' => new sfWidgetFormInput(),
            'txtDepAddressTA' => new sfWidgetFormInput(),
            'txtDepComment' => new sfWidgetFormInput(),
            'txtDepCommentSI' => new sfWidgetFormInput(),
            'txtDepCommentTA' => new sfWidgetFormInput(),
        ));

        $this->setValidators(array(
            'txtDepSeqNo' => new sfValidatorNumber(array('required' => false)),
            'txtDepName' => new sfValidatorString(array('required' => true)),
            'txtDepNameSI' => new sfValidatorString(array('required' => false)),
            'txtDepNameTA' => new sfValidatorString(array('required' => false)),
            'cmbDepRelationship' => new sfValidatorString(array('required' => false)),
            'txtDepDOB' => new sfValidatorString(array('required' => false)),
            'txtDepWorkplace' => new sfValidatorString(array('required' => false)),
            'txtDepWorkplaceSI' => new sfValidatorString(array('required' => false)),
            'txtDepWorkplaceTA' => new sfValidatorString(array('required' => false)),
            'txtDepEduCenter' => new sfValidatorString(array('required' => false)),
            'txtDepEduCenterSI' => new sfValidatorString(array('required' => false)),
            'txtDepEduCenterTA' => new sfValidatorString(array('required' => false)),
            'txtDepAddress' => new sfValidatorString(array('required' => false)),
            'txtDepAddressSI' => new sfValidatorString(array('required' => false)),
            'txtDepAddressTA' => new sfValidatorString(array('required' => false)),
            'txtDepComment' => new sfValidatorString(array('required' => false)),
            'txtDepCommentSI' => new sfValidatorString(array('required' => false)),
            'txtDepCommentTA' => new sfValidatorString(array('required' => false)),
        ));
    }
    
    /**
     * Get employee dependent contact object
     */
    public function getDependentContact($empNumber,$seqNo) {

        $dependent = Doctrine::getTable('EmpDependent')->find(array('emp_number' => $empNumber,
                                                                      'seqno' => $seqNo));

        if (is_object($dependent)==false) {
            $dependent = new EmpDependent();
            $dependent->emp_number=$empNumber;

            $q = Doctrine_Query::create()
                    ->select('MAX(d.seqno)')
                    ->from('EmpDependent d')
                    ->where('d.emp_number = ?', $empNumber);
            $result = $q->execute(array(), Doctrine::HYDRATE_ARRAY);

            if (count($result) != 1) {
                throw new PIMServiceException('MAX(seqno) failed.');
            }

            $dependent->seqno = is_null($result[0]['MAX']) ? 1 : $result[0]['MAX'] + 1;
        }

        $dependent->name = $this->getValue('txtDepName');
        $dependent->name_si = $this->getValue('txtDepNameSI');
        $dependent->name_ta = $this->getValue('txtDepNameTA');

        $relationship = $this->getValue('cmbDepRelationship');
        $dependent->rel_code = ($relationship != '0') ? $relationship : null;        
        if($this->getValue('txtDepDOB')!= null){
        $dependent->birthday = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtDepDOB'));
        }else{
            $dependent->birthday =null;
        }
        $dependent->workplace = $this->getValue('txtDepWorkplace');
        $dependent->workplace_si = $this->getValue('txtDepWorkplaceSI');
        $dependent->workplace_ta = $this->getValue('txtDepWorkplaceTA');

        $dependent->education_center = $this->getValue('txtDepEduCenter');
        $dependent->education_center_si = $this->getValue('txtDepEduCenterSI');
        $dependent->education_center_ta = $this->getValue('txtDepEduCenterTA');

        $dependent->address = $this->getValue('txtDepAddress');
        $dependent->address_si = $this->getValue('txtDepAddressSI');
        $dependent->address_ta = $this->getValue('txtDepAddressTA');

        $dependent->comments = $this->getValue('txtDepComment');
        $dependent->comments_si = $this->getValue('txtDepCommentSI');
        $dependent->comments_ta = $this->getValue('txtDepCommentTA');

        return $dependent;
    }

}

