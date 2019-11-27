<?php

/**
 * EmpPassport form base class.
 *
 * @package    form
 * @subpackage emp_passport
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpPassportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number'           => new sfWidgetFormInputHidden(),
      'seqno'                => new sfWidgetFormInputHidden(),
      'number'               => new sfWidgetFormInput(),
      'i9_status'            => new sfWidgetFormInput(),
      'passport_issue_date'  => new sfWidgetFormDateTime(),
      'passport_expire_date' => new sfWidgetFormDateTime(),
      'comments'             => new sfWidgetFormInput(),
      'type_flag'            => new sfWidgetFormInput(),
      'i9_review_date'       => new sfWidgetFormDate(),
      'country'              => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'emp_number'           => new sfValidatorDoctrineChoice(array('model' => 'EmpPassport', 'column' => 'emp_number', 'required' => false)),
      'seqno'                => new sfValidatorDoctrineChoice(array('model' => 'EmpPassport', 'column' => 'ep_seqno', 'required' => false)),
      'number'               => new sfValidatorString(array('max_length' => 100)),
      'i9_status'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'passport_issue_date'  => new sfValidatorDateTime(array('required' => false)),
      'passport_expire_date' => new sfValidatorDateTime(array('required' => false)),
      'comments'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type_flag'            => new sfValidatorInteger(array('required' => false)),
      'i9_review_date'       => new sfValidatorDate(array('required' => false)),
      'country'              => new sfValidatorString(array('max_length' => 6, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emp_passport[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpPassport';
  }

}
