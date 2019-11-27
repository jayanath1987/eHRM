<?php

/**
 * MailNotification form base class.
 *
 * @package    form
 * @subpackage mail_notification
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMailNotificationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'              => new sfWidgetFormInputHidden(),
      'notification_type_id' => new sfWidgetFormInputHidden(),
      'status'               => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'user_id'              => new sfValidatorDoctrineChoice(array('model' => 'MailNotification', 'column' => 'user_id', 'required' => false)),
      'notification_type_id' => new sfValidatorDoctrineChoice(array('model' => 'MailNotification', 'column' => 'notification_type_id', 'required' => false)),
      'status'               => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('mail_notification[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MailNotification';
  }

}
