<?php

/**
 * Payperiod form base class.
 *
 * @package    form
 * @subpackage payperiod
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePayperiodForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code' => new sfWidgetFormInputHidden(),
      'name' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'code' => new sfValidatorDoctrineChoice(array('model' => 'Payperiod', 'column' => 'payperiod_code', 'required' => false)),
      'name' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('payperiod[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Payperiod';
  }

}
