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
class EmployeeChildForm extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'EmpID' => new sfWidgetFormInputHidden(),
            'txtCSeqNo' => new sfWidgetFormInputHidden(), // seq no
            'txtChiName' => new sfWidgetFormInput(),
			'ChiDOB' => new sfWidgetFormInput(),
        ));

        $this->setValidators(array(
            'EmpID' => new sfValidatorNumber(array('required' => true, 'min'=> 0)),
            'txtCSeqNo' => new sfValidatorNumber(array('required' => false, 'min' => 1)),
            'txtChiName' => new sfValidatorString(array('required' => true)),
            'ChiDOB' => new sfValidatorString(array('required' => true, 'trim'=>true))
        ));

        // set up your post validator method
        $this->validatorSchema->setPostValidator(
          new sfValidatorCallback(array(
            'callback' => array($this, 'postValidate')
          ))
        );        
    }

    public function postValidate($validator, $values) {

        $dob = $values['ChiDOB'];

        $dob = LocaleUtil::getInstance()->convertToStandardDateFormat($dob);
        $values['ChiDOB'] = $dob;

        if (empty($dob)) {
            $message = sfContext::getInstance()->getI18N()->__('Invalid date format');
            $error = new sfValidatorError($validator, $message);
            throw new sfValidatorErrorSchema($validator, array('ChiDOB' => $error));
        }

        return $values;
    }


    /**
     * Save employee contract
     */
    public function save() {

        $empNumber = $this->getValue('EmpID');
        $seqNo = $this->getValue('txtCSeqNo');

        $child = false;

        if (empty($seqNo)) {

            $q = Doctrine_Query::create()
                    ->select('MAX(c.seqno)')
                    ->from('EmpChild c')
                    ->where('c.emp_number = ?', $empNumber);
            $result = $q->execute(array(), Doctrine::HYDRATE_ARRAY);

            if (count($result) != 1) {
                throw new PIMServiceException('MAX(seqno) failed.');
            }
            $seqNo = is_null($result[0]['MAX']) ? 1 : $result[0]['MAX'] + 1;

        } else {
            $child = Doctrine::getTable('EmpChild')->find(array('emp_number' => $empNumber,
                                                                'seqno' => $seqNo));

            if ($child == false) {
                throw new PIMServiceException('Invalid child');
            }
        }

        if ($child === false) {
            $child = new EmpChild();
            $child->emp_number = $empNumber;
            $child->seqno = $seqNo;
        }

        $child->name = $this->getValue('txtChiName');
        $child->dob = $this->getValue('ChiDOB');

        $child->save();
    }

}

