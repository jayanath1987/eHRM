<?php

/**
 * EmpJobtitleHistory form base class.
 *
 * @package    form
 * @subpackage emp_jobtitle_history
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpJobtitleHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'emp_number' => new sfWidgetFormDoctrineChoice(array('model' => 'Employee', 'add_empty' => false)),
      'code'       => new sfWidgetFormInput(),
      'name'       => new sfWidgetFormInput(),
      'start_date' => new sfWidgetFormDateTime(),
      'end_date'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'EmpJobtitleHistory', 'column' => 'id', 'required' => false)),
      'emp_number' => new sfValidatorDoctrineChoice(array('model' => 'Employee')),
      'code'       => new sfValidatorString(array('max_length' => 15)),
      'name'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'start_date' => new sfValidatorDateTime(array('required' => false)),
      'end_date'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_jobtitle_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpJobtitleHistory';
  }

}
