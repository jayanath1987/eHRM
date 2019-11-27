<?php

/**
 * EmployeeStatus form base class.
 *
 * @package    form
 * @subpackage employee_status
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmployeeStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInput(),
      'job_titles_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'JobTitle')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => 'EmployeeStatus', 'column' => 'estat_code', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'job_titles_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'JobTitle', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('employee_status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmployeeStatus';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['job_titles_list']))
    {
      $this->setDefault('job_titles_list', $this->object->jobTitles->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savejobTitlesList($con);
  }

  public function savejobTitlesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['job_titles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->jobTitles->getPrimaryKeys();
    $values = $this->getValue('job_titles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('jobTitles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('jobTitles', array_values($link));
    }
  }

}
