<?php

/**
 * LeavePeriod form base class.
 *
 * @package    form
 * @subpackage leave_period
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseLeavePeriodForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'leavePeriodId' => new sfWidgetFormInputHidden(),
      'startDate'     => new sfWidgetFormDate(),
      'endDate'       => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'leavePeriodId' => new sfValidatorDoctrineChoice(array('model' => 'LeavePeriod', 'column' => 'leave_period_id', 'required' => false)),
      'startDate'     => new sfValidatorDate(array('required' => false)),
      'endDate'       => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('leave_period[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeavePeriod';
  }

}
