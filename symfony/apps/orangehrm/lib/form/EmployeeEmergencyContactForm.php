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
 * Form class for employee contact detail
 */
class EmployeeEmergencyContactForm extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(            
            'txtECSeqNo' => new sfWidgetFormInputHidden(),
            'txtECName' => new sfWidgetFormInput(),
            'txtECNameSI' => new sfWidgetFormInput(),
            'txtECNameTA' => new sfWidgetFormInput(),
            'txtECRelationship' => new sfWidgetFormInput(),
            'txtECRelationshipSI' => new sfWidgetFormInput(),
            'txtECRelationshipTA' => new sfWidgetFormInput(),
            'txtECAddress' => new sfWidgetFormInput(),
            'txtECAddressSI' => new sfWidgetFormInput(),
            'txtECAddressTA' => new sfWidgetFormInput(),
            'txtECHomePhoneNo' => new sfWidgetFormInput(),
            'txtECOfficePhoneNo' => new sfWidgetFormInput(),
            'txtECMobileNo' => new sfWidgetFormInput(),
        ));

        $this->setValidators(array(            
            'txtECSeqNo' => new sfValidatorNumber(array('required' => false)),
            'txtECName' => new sfValidatorString(array('required' => true)),
            'txtECNameSI' => new sfValidatorString(array('required' => false)),
            'txtECNameTA' => new sfValidatorString(array('required' => false)),
            'txtECRelationship' => new sfValidatorString(array('required' => false)),
            'txtECRelationshipSI' => new sfValidatorString(array('required' => false)),
            'txtECRelationshipTA' => new sfValidatorString(array('required' => false)),
            'txtECAddress' => new sfValidatorString(array('required' => false)),
            'txtECAddressSI' => new sfValidatorString(array('required' => false)),
            'txtECAddressTA' => new sfValidatorString(array('required' => false)),
            'txtECHomePhoneNo' => new sfValidatorString(array('required' => false)),
            'txtECOfficePhoneNo' => new sfValidatorString(array('required' => false)),
            'txtECMobileNo' => new sfValidatorString(array('required' => false)),
        ));

        // set up your post validator method
//        $this->validatorSchema->setPostValidator(
//          new sfValidatorCallback(array(
//            'callback' => array($this, 'postValidate')
//          ))
//        );
    }

//    public function postValidate($validator, $values) {
//
//        $homePhone = $values['txtEConHmTel'];
//        $mobile = $values['txtEConMobile'];
//        $workPhone = $values['txtEConWorkTel'];
//
//        if (empty($homePhone) && empty($mobile) && empty($workPhone)) {
//
//            $message = sfContext::getInstance()->getI18N()->__('Please specify at least one phone number.');
//            $error = new sfValidatorError($validator, $message);
//            throw new sfValidatorErrorSchema($validator, array('' => $error));
//
//        }
//
//        return $values;
//    }


    /**
     * Get employee emergency contact object
     */
    public function getEmergencyContact($empNumber,$seqNo) {

        $emgContact = Doctrine::getTable('EmpEmergencyContact')->find(array('emp_number' => $empNumber,
                                                                                'seqno' => $seqNo));
                
        if (is_object($emgContact)==false) {
            $emgContact = new EmpEmergencyContact();
            $emgContact->emp_number=$empNumber;

            $q = Doctrine_Query::create()
                    ->select('MAX(ec.seqno)')
                    ->from('EmpEmergencyContact ec')
                    ->where('ec.emp_number = ?', $empNumber);
            $result = $q->execute(array(), Doctrine::HYDRATE_ARRAY);

            if (count($result) != 1) {
                throw new PIMServiceException('MAX(seqno) failed.');
            }

            $emgContact->seqno = is_null($result[0]['MAX']) ? 1 : $result[0]['MAX'] + 1;
        }
        
        $emgContact->name = $this->getValue('txtECName');
        $emgContact->name_si = $this->getValue('txtECNameSI');
        $emgContact->name_ta = $this->getValue('txtECNameTA');
        $emgContact->relationship = $this->getValue('txtECRelationship');
        $emgContact->relationship_si = $this->getValue('txtECRelationshipSI');
        $emgContact->relationship_ta = $this->getValue('txtECRelationshipTA');
        $emgContact->address = $this->getValue('txtECAddress');
        $emgContact->address_si = $this->getValue('txtECAddressSI');
        $emgContact->address_ta = $this->getValue('txtECAddressTA');
        $emgContact->home_phone = $this->getValue('txtECHomePhoneNo');
        $emgContact->office_phone = $this->getValue('txtECOfficePhoneNo');
        $emgContact->mobile_phone = $this->getValue('txtECMobileNo');
                
        return $emgContact;
    }
}

