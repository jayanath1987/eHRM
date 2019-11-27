<?php

/**
 * EmpLocation form base class.
 *
 * @package    form
 * @subpackage emp_location
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpLocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'empNumber' => new sfWidgetFormInputHidden(),
      'loc_code'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'empNumber' => new sfValidatorDoctrineChoice(array('model' => 'EmpLocation', 'column' => 'emp_number', 'required' => false)),
      'loc_code'  => new sfValidatorDoctrineChoice(array('model' => 'EmpLocation', 'column' => 'loc_code', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpLocation';
  }

}
