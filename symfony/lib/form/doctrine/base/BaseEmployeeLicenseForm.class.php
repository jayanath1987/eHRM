<?php

/**
 * EmployeeLicense form base class.
 *
 * @package    form
 * @subpackage employee_license
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmployeeLicenseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'empNumber'    => new sfWidgetFormInputHidden(),
      'code'         => new sfWidgetFormInputHidden(),
      'date'         => new sfWidgetFormDate(),
      'renewal_date' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'empNumber'    => new sfValidatorDoctrineChoice(array('model' => 'EmployeeLicense', 'column' => 'emp_number', 'required' => false)),
      'code'         => new sfValidatorDoctrineChoice(array('model' => 'EmployeeLicense', 'column' => 'licenses_code', 'required' => false)),
      'date'         => new sfValidatorDate(array('required' => false)),
      'renewal_date' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('employee_license[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmployeeLicense';
  }

}
