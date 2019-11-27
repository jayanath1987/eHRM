<?php

/**
 * EmpEmergencyContact form base class.
 *
 * @package    form
 * @subpackage emp_emergency_contact
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpEmergencyContactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number'   => new sfWidgetFormInputHidden(),
      'seqno'        => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInput(),
      'relationship' => new sfWidgetFormInput(),
      'home_phone'   => new sfWidgetFormInput(),
      'mobile_phone' => new sfWidgetFormInput(),
      'office_phone' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'emp_number'   => new sfValidatorDoctrineChoice(array('model' => 'EmpEmergencyContact', 'column' => 'emp_number', 'required' => false)),
      'seqno'        => new sfValidatorDoctrineChoice(array('model' => 'EmpEmergencyContact', 'column' => 'eec_seqno', 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'relationship' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'home_phone'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'mobile_phone' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'office_phone' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_emergency_contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpEmergencyContact';
  }

}
