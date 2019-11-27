<?php

/**
 * EmpAttachment form base class.
 *
 * @package    form
 * @subpackage emp_attachment
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpAttachmentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number'  => new sfWidgetFormInputHidden(),
      'attach_id'   => new sfWidgetFormInputHidden(),
      'size'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormInput(),
      'filename'    => new sfWidgetFormInput(),
      'attachment'  => new sfWidgetFormTextarea(),
      'file_type'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'emp_number'  => new sfValidatorDoctrineChoice(array('model' => 'EmpAttachment', 'column' => 'emp_number', 'required' => false)),
      'attach_id'   => new sfValidatorDoctrineChoice(array('model' => 'EmpAttachment', 'column' => 'eattach_id', 'required' => false)),
      'size'        => new sfValidatorInteger(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'filename'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'attachment'  => new sfValidatorString(array('required' => false)),
      'file_type'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_attachment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpAttachment';
  }

}
