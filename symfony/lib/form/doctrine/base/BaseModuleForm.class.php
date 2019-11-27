<?php

/**
 * Module form base class.
 *
 * @package    form
 * @subpackage module
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseModuleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mod_id'      => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'owner'       => new sfWidgetFormInput(),
      'owner_email' => new sfWidgetFormInput(),
      'version'     => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'mod_id'      => new sfValidatorDoctrineChoice(array('model' => 'Module', 'column' => 'mod_id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'owner'       => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'owner_email' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'version'     => new sfValidatorString(array('max_length' => 36, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('module[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Module';
  }

}
