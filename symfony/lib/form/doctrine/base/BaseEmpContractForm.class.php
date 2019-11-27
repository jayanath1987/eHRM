<?php

/**
 * EmpContract form base class.
 *
 * @package    form
 * @subpackage emp_contract
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpContractForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number'  => new sfWidgetFormInputHidden(),
      'contract_id' => new sfWidgetFormInputHidden(),
      'start_date'  => new sfWidgetFormDateTime(),
      'end_date'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'emp_number'  => new sfValidatorDoctrineChoice(array('model' => 'EmpContract', 'column' => 'emp_number', 'required' => false)),
      'contract_id' => new sfValidatorDoctrineChoice(array('model' => 'EmpContract', 'column' => 'econ_extend_id', 'required' => false)),
      'start_date'  => new sfValidatorDateTime(array('required' => false)),
      'end_date'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_contract[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpContract';
  }

}
