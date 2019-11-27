<?php

/**
 * Users form base class.
 *
 * @package    form
 * @subpackage users
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseUsersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'user_name'            => new sfWidgetFormInput(),
      'is_admin'             => new sfWidgetFormInput(),
      'receive_notification' => new sfWidgetFormInput(),
      'deleted'              => new sfWidgetFormInput(),
      'user_password'        => new sfWidgetFormInput(),
      'first_name'           => new sfWidgetFormInput(),
      'last_name'            => new sfWidgetFormInput(),
      'emp_number'           => new sfWidgetFormDoctrineChoice(array('model' => 'Employee', 'add_empty' => true)),
      'user_hash'            => new sfWidgetFormInput(),
      'description'          => new sfWidgetFormTextarea(),
      'date_entered'         => new sfWidgetFormDateTime(),
      'date_modified'        => new sfWidgetFormDateTime(),
      'modified_user_id'     => new sfWidgetFormDoctrineChoice(array('model' => 'Users', 'add_empty' => true)),
      'created_by'           => new sfWidgetFormInput(),
      'title'                => new sfWidgetFormInput(),
      'department'           => new sfWidgetFormInput(),
      'phone_home'           => new sfWidgetFormInput(),
      'phone_mobile'         => new sfWidgetFormInput(),
      'phone_work'           => new sfWidgetFormInput(),
      'phone_other'          => new sfWidgetFormInput(),
      'phone_fax'            => new sfWidgetFormInput(),
      'email1'               => new sfWidgetFormInput(),
      'email2'               => new sfWidgetFormInput(),
      'status'               => new sfWidgetFormInput(),
      'address_street'       => new sfWidgetFormInput(),
      'address_city'         => new sfWidgetFormInput(),
      'address_state'        => new sfWidgetFormInput(),
      'address_country'      => new sfWidgetFormInput(),
      'address_postalcode'   => new sfWidgetFormInput(),
      'user_preferences'     => new sfWidgetFormTextarea(),
      'employee_status'      => new sfWidgetFormInput(),
      'userg_id'             => new sfWidgetFormDoctrineChoice(array('model' => 'UserGroup', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'user_name'            => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'is_admin'             => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'receive_notification' => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'deleted'              => new sfValidatorInteger(),
      'user_password'        => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'first_name'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'last_name'            => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'emp_number'           => new sfValidatorDoctrineChoice(array('model' => 'Employee', 'required' => false)),
      'user_hash'            => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'description'          => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'date_entered'         => new sfValidatorDateTime(array('required' => false)),
      'date_modified'        => new sfValidatorDateTime(array('required' => false)),
      'modified_user_id'     => new sfValidatorDoctrineChoice(array('model' => 'Users', 'required' => false)),
      'created_by'           => new sfValidatorString(array('max_length' => 36, 'required' => false)),
      'title'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'department'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'phone_home'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'phone_mobile'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'phone_work'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'phone_other'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'phone_fax'            => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'email1'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email2'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'status'               => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'address_street'       => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'address_city'         => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'address_state'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'address_country'      => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'address_postalcode'   => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'user_preferences'     => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'employee_status'      => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'userg_id'             => new sfValidatorDoctrineChoice(array('model' => 'UserGroup', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

}
