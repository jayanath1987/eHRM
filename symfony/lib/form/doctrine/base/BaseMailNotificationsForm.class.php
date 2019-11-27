<?php

/**
 * MailNotifications form base class.
 *
 * @package    form
 * @subpackage mail_notifications
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMailNotificationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'user_id'              => new sfWidgetFormDoctrineChoice(array('model' => 'Users', 'add_empty' => false)),
      'notification_type_id' => new sfWidgetFormInput(),
      'status'               => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorDoctrineChoice(array('model' => 'MailNotifications', 'column' => 'id', 'required' => false)),
      'user_id'              => new sfValidatorDoctrineChoice(array('model' => 'Users')),
      'notification_type_id' => new sfValidatorInteger(),
      'status'               => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('mail_notifications[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MailNotifications';
  }

}
