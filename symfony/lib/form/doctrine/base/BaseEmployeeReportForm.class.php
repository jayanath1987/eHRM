<?php

/**
 * EmployeeReport form base class.
 *
 * @package    form
 * @subpackage employee_report
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmployeeReportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reportCode'     => new sfWidgetFormInputHidden(),
      'reportName'     => new sfWidgetFormInput(),
      'reportCriteria' => new sfWidgetFormTextarea(),
      'reportFields'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'reportCode'     => new sfValidatorDoctrineChoice(array('model' => 'EmployeeReport', 'column' => 'rep_code', 'required' => false)),
      'reportName'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'reportCriteria' => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'reportFields'   => new sfValidatorString(array('max_length' => 500, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('employee_report[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmployeeReport';
  }

}
