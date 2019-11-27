<?php

/**
 * EmpDependent form base class.
 *
 * @package    form
 * @subpackage emp_dependent
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpDependentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number'   => new sfWidgetFormInputHidden(),
      'seqno'        => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInput(),
      'relationship' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'emp_number'   => new sfValidatorDoctrineChoice(array('model' => 'EmpDependent', 'column' => 'emp_number', 'required' => false)),
      'seqno'        => new sfValidatorDoctrineChoice(array('model' => 'EmpDependent', 'column' => 'ed_seqno', 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'relationship' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_dependent[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpDependent';
  }

}
