<?php

/**
 * CustomExport form base class.
 *
 * @package    form
 * @subpackage custom_export
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCustomExportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'export_id' => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInput(),
      'fields'    => new sfWidgetFormTextarea(),
      'headings'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'export_id' => new sfValidatorDoctrineChoice(array('model' => 'CustomExport', 'column' => 'export_id', 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 250)),
      'fields'    => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'headings'  => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('custom_export[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomExport';
  }

}
