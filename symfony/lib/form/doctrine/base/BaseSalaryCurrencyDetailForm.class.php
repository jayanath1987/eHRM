<?php

/**
 * SalaryCurrencyDetail form base class.
 *
 * @package    form
 * @subpackage salary_currency_detail
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSalaryCurrencyDetailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sal_grd_code' => new sfWidgetFormInputHidden(),
      'currency_id'  => new sfWidgetFormInputHidden(),
      'min_salary'   => new sfWidgetFormInput(),
      'salary_step'  => new sfWidgetFormInput(),
      'max_salary'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'sal_grd_code' => new sfValidatorDoctrineChoice(array('model' => 'SalaryCurrencyDetail', 'column' => 'sal_grd_code', 'required' => false)),
      'currency_id'  => new sfValidatorDoctrineChoice(array('model' => 'SalaryCurrencyDetail', 'column' => 'currency_id', 'required' => false)),
      'min_salary'   => new sfValidatorNumber(array('required' => false)),
      'salary_step'  => new sfValidatorNumber(array('required' => false)),
      'max_salary'   => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('salary_currency_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SalaryCurrencyDetail';
  }

}
