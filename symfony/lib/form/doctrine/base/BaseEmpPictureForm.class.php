<?php

/**
 * EmpPicture form base class.
 *
 * @package    form
 * @subpackage emp_picture
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpPictureForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number' => new sfWidgetFormInputHidden(),
      'picture'    => new sfWidgetFormTextarea(),
      'filename'   => new sfWidgetFormInput(),
      'file_type'  => new sfWidgetFormInput(),
      'size'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'emp_number' => new sfValidatorDoctrineChoice(array('model' => 'EmpPicture', 'column' => 'emp_number', 'required' => false)),
      'picture'    => new sfValidatorString(array('required' => false)),
      'filename'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'file_type'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'size'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_picture[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpPicture';
  }

}
