<?php

/**
 * EmployeeUsergroup form base class.
 *
 * @package    form
 * @subpackage employee_usergroup
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmployeeUsergroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userg_id' => new sfWidgetFormInputHidden(),
      'rep_code' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'userg_id' => new sfValidatorDoctrineChoice(array('model' => 'EmployeeUsergroup', 'column' => 'userg_id', 'required' => false)),
      'rep_code' => new sfValidatorDoctrineChoice(array('model' => 'EmployeeUsergroup', 'column' => 'rep_code', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('employee_usergroup[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmployeeUsergroup';
  }

}
