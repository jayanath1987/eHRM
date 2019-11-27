<?php

/**
 * DaysOff form base class.
 *
 * @package    form
 * @subpackage days_off
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDaysOffForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'day'    => new sfWidgetFormInputHidden(),
      'length' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'day'    => new sfValidatorDoctrineChoice(array('model' => 'DaysOff', 'column' => 'day', 'required' => false)),
      'length' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('days_off[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DaysOff';
  }

}
