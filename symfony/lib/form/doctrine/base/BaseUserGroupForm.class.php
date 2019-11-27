<?php

/**
 * UserGroup form base class.
 *
 * @package    form
 * @subpackage user_group
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseUserGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userg_id'     => new sfWidgetFormInputHidden(),
      'userg_repdef' => new sfWidgetFormInput(),
      'userg_name'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'userg_id'     => new sfValidatorDoctrineChoice(array('model' => 'UserGroup', 'column' => 'userg_id', 'required' => false)),
      'userg_repdef' => new sfValidatorInteger(array('required' => false)),
      'userg_name'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserGroup';
  }

}
