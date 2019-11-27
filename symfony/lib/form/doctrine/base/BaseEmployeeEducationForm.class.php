<?php

/**
 * EmployeeEducation form base class.
 *
 * @package    form
 * @subpackage employee_education
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmployeeEducationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number' => new sfWidgetFormInputHidden(),
      'code'       => new sfWidgetFormInputHidden(),
      'major'      => new sfWidgetFormInput(),
      'year'       => new sfWidgetFormInput(),
      'gpa'        => new sfWidgetFormInput(),
      'start_date' => new sfWidgetFormDateTime(),
      'end_date'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'emp_number' => new sfValidatorDoctrineChoice(array('model' => 'EmployeeEducation', 'column' => 'emp_number', 'required' => false)),
      'code'       => new sfValidatorDoctrineChoice(array('model' => 'EmployeeEducation', 'column' => 'edu_code', 'required' => false)),
      'major'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'year'       => new sfValidatorNumber(array('required' => false)),
      'gpa'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'start_date' => new sfValidatorDateTime(array('required' => false)),
      'end_date'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('employee_education[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmployeeEducation';
  }

}
