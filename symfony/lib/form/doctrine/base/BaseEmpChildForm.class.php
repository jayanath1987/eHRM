<?php

/**
 * EmpChild form base class.
 *
 * @package    form
 * @subpackage emp_child
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpChildForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number' => new sfWidgetFormInputHidden(),
      'seqno'      => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInput(),
      'dob'        => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'emp_number' => new sfValidatorDoctrineChoice(array('model' => 'EmpChild', 'column' => 'emp_number', 'required' => false)),
      'seqno'      => new sfValidatorDoctrineChoice(array('model' => 'EmpChild', 'column' => 'ec_seqno', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'dob'        => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_child[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpChild';
  }

}
