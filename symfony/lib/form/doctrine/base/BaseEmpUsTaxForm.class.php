<?php

/**
 * EmpUsTax form base class.
 *
 * @package    form
 * @subpackage emp_us_tax
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpUsTaxForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number'         => new sfWidgetFormInputHidden(),
      'federal_exceptions' => new sfWidgetFormInput(),
      'state_exceptions'   => new sfWidgetFormInput(),
      'federal_status'     => new sfWidgetFormInput(),
      'state'              => new sfWidgetFormInput(),
      'state_status'       => new sfWidgetFormInput(),
      'unemp_state'        => new sfWidgetFormInput(),
      'work_state'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'emp_number'         => new sfValidatorDoctrineChoice(array('model' => 'EmpUsTax', 'column' => 'emp_number', 'required' => false)),
      'federal_exceptions' => new sfValidatorInteger(array('required' => false)),
      'state_exceptions'   => new sfValidatorInteger(array('required' => false)),
      'federal_status'     => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'state'              => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'state_status'       => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'unemp_state'        => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'work_state'         => new sfValidatorString(array('max_length' => 13, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_us_tax[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpUsTax';
  }

}
