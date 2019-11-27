<?php

/**
 * EmpDirectdebit form base class.
 *
 * @package    form
 * @subpackage emp_directdebit
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmpDirectdebitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'emp_number'       => new sfWidgetFormInputHidden(),
      'seqno'            => new sfWidgetFormInputHidden(),
      'routing_num'      => new sfWidgetFormInput(),
      'account'          => new sfWidgetFormInput(),
      'amount'           => new sfWidgetFormInput(),
      'account_type'     => new sfWidgetFormInput(),
      'transaction_type' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'emp_number'       => new sfValidatorDoctrineChoice(array('model' => 'EmpDirectdebit', 'column' => 'emp_number', 'required' => false)),
      'seqno'            => new sfValidatorDoctrineChoice(array('model' => 'EmpDirectdebit', 'column' => 'dd_seqno', 'required' => false)),
      'routing_num'      => new sfValidatorInteger(),
      'account'          => new sfValidatorString(array('max_length' => 100)),
      'amount'           => new sfValidatorNumber(),
      'account_type'     => new sfValidatorString(array('max_length' => 20)),
      'transaction_type' => new sfValidatorString(array('max_length' => 20)),
    ));

    $this->widgetSchema->setNameFormat('emp_directdebit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpDirectdebit';
  }

}
