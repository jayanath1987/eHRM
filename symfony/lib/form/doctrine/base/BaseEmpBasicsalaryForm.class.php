<?php

/**
 * EmpBasicsalary form base class.
 *
 * @package    form
 * @subpackage emp_basicsalary
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpBasicsalaryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number'     => new sfWidgetFormInputHidden(),
      'sal_grd_code'   => new sfWidgetFormInputHidden(),
      'currency_id'    => new sfWidgetFormInputHidden(),
      'basic_salary'   => new sfWidgetFormInput(),
      'payperiod_code' => new sfWidgetFormDoctrineChoice(array('model' => 'Payperiod', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'emp_number'     => new sfValidatorDoctrineChoice(array('model' => 'EmpBasicsalary', 'column' => 'emp_number', 'required' => false)),
      'sal_grd_code'   => new sfValidatorDoctrineChoice(array('model' => 'EmpBasicsalary', 'column' => 'sal_grd_code', 'required' => false)),
      'currency_id'    => new sfValidatorDoctrineChoice(array('model' => 'EmpBasicsalary', 'column' => 'currency_id', 'required' => false)),
      'basic_salary'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'payperiod_code' => new sfValidatorDoctrineChoice(array('model' => 'Payperiod', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_basicsalary[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpBasicsalary';
  }

}
