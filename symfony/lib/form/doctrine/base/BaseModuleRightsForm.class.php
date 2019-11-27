<?php

/**
 * ModuleRights form base class.
 *
 * @package    form
 * @subpackage module_rights
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseModuleRightsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userg_id' => new sfWidgetFormInputHidden(),
      'mod_id'   => new sfWidgetFormInputHidden(),
      'addition' => new sfWidgetFormInput(),
      'editing'  => new sfWidgetFormInput(),
      'deletion' => new sfWidgetFormInput(),
      'viewing'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'userg_id' => new sfValidatorDoctrineChoice(array('model' => 'ModuleRights', 'column' => 'userg_id', 'required' => false)),
      'mod_id'   => new sfValidatorDoctrineChoice(array('model' => 'ModuleRights', 'column' => 'mod_id', 'required' => false)),
      'addition' => new sfValidatorInteger(array('required' => false)),
      'editing'  => new sfValidatorInteger(array('required' => false)),
      'deletion' => new sfValidatorInteger(array('required' => false)),
      'viewing'  => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('module_rights[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ModuleRights';
  }

}
