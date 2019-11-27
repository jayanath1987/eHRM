<?php

/**
 * EmpWorkExperience form base class.
 *
 * @package    form
 * @subpackage emp_work_experience
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpWorkExperienceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number' => new sfWidgetFormInputHidden(),
      'seqno'      => new sfWidgetFormInputHidden(),
      'employer'   => new sfWidgetFormInput(),
      'jobtitle'   => new sfWidgetFormInput(),
      'from_date'  => new sfWidgetFormDateTime(),
      'to_date'    => new sfWidgetFormDateTime(),
      'comments'   => new sfWidgetFormInput(),
      'internal'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'emp_number' => new sfValidatorDoctrineChoice(array('model' => 'EmpWorkExperience', 'column' => 'emp_number', 'required' => false)),
      'seqno'      => new sfValidatorDoctrineChoice(array('model' => 'EmpWorkExperience', 'column' => 'eexp_seqno', 'required' => false)),
      'employer'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'jobtitle'   => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'from_date'  => new sfValidatorDateTime(array('required' => false)),
      'to_date'    => new sfValidatorDateTime(array('required' => false)),
      'comments'   => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'internal'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_work_experience[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpWorkExperience';
  }

}
