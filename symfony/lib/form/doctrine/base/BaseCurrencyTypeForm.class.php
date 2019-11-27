<?php

/**
 * CurrencyType form base class.
 *
 * @package    form
 * @subpackage currency_type
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCurrencyTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'          => new sfWidgetFormInput(),
      'currency_id'   => new sfWidgetFormInputHidden(),
      'currency_name' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'code'          => new sfValidatorInteger(),
      'currency_id'   => new sfValidatorDoctrineChoice(array('model' => 'CurrencyType', 'column' => 'currency_id', 'required' => false)),
      'currency_name' => new sfValidatorString(array('max_length' => 70)),
    ));

    $this->widgetSchema->setNameFormat('currency_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurrencyType';
  }

}
