<?php

/**
 * LeaveType form base class.
 *
 * @package    form
 * @subpackage leave_type
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseLeaveTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'leaveTypeId'   => new sfWidgetFormInputHidden(),
      'leaveTypeName' => new sfWidgetFormInput(),
      'availableFlag' => new sfWidgetFormInput(),
      'leaveRules'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'leaveTypeId'   => new sfValidatorDoctrineChoice(array('model' => 'LeaveType', 'column' => 'leave_type_id', 'required' => false)),
      'leaveTypeName' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'availableFlag' => new sfValidatorInteger(array('required' => false)),
      'leaveRules'    => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('leave_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LeaveType';
  }

}
