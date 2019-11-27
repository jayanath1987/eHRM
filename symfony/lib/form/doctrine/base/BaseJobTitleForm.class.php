<?php

/**
 * JobTitle form base class.
 *
 * @package    form
 * @subpackage job_title
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseJobTitleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInput(),
      'description'            => new sfWidgetFormInput(),
      'comments'               => new sfWidgetFormTextarea(),
      'salaryGradeId'          => new sfWidgetFormInput(),
      'jobspecId'              => new sfWidgetFormInput(),
      'employee_statuses_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'EmployeeStatus')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => 'JobTitle', 'column' => 'jobtit_code', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description'            => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'comments'               => new sfValidatorString(array('max_length' => 400, 'required' => false)),
      'salaryGradeId'          => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'jobspecId'              => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'employee_statuses_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'EmployeeStatus', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_title[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobTitle';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['employee_statuses_list']))
    {
      $this->setDefault('employee_statuses_list', $this->object->employeeStatuses->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveemployeeStatusesList($con);
  }

  public function saveemployeeStatusesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['employee_statuses_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->employeeStatuses->getPrimaryKeys();
    $values = $this->getValue('employee_statuses_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('employeeStatuses', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('employeeStatuses', array_values($link));
    }
  }

}
