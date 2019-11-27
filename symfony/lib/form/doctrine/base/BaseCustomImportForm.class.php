<?php

/**
 * CustomImport form base class.
 *
 * @package    form
 * @subpackage custom_import
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCustomImportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'import_id'   => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'has_heading' => new sfWidgetFormInput(),
      'fields'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'import_id'   => new sfValidatorDoctrineChoice(array('model' => 'CustomImport', 'column' => 'import_id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 250)),
      'has_heading' => new sfValidatorInteger(array('required' => false)),
      'fields'      => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('custom_import[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomImport';
  }

}
