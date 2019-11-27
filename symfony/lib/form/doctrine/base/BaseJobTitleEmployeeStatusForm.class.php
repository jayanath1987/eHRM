<?php

/**
 * JobTitleEmployeeStatus form base class.
 *
 * @package    form
 * @subpackage job_title_employee_status
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseJobTitleEmployeeStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'jobtit_code' => new sfWidgetFormInputHidden(),
      'estat_code'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'jobtit_code' => new sfValidatorDoctrineChoice(array('model' => 'JobTitleEmployeeStatus', 'column' => 'jobtit_code', 'required' => false)),
      'estat_code'  => new sfValidatorDoctrineChoice(array('model' => 'JobTitleEmployeeStatus', 'column' => 'estat_code', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_title_employee_status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobTitleEmployeeStatus';
  }

}
