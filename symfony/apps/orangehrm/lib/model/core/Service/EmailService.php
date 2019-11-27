<?php

class EmailService extends BaseService
{

    const EMAILCONFIGURATION_SMTP_SECURITY_NONE = 'NONE';
    const EMAILCONFIGURATION_SMTP_SECURITY_TLS = 'TLS';
    const EMAILCONFIGURATION_SMTP_SECURITY_SSL = 'SSL';

    const EMAILCONFIGURATION_SMTP_AUTH_NONE = 'NONE';
    const EMAILCONFIGURATION_SMTP_AUTH_LOGIN = 'LOGIN';


    private $message 	=	'';

    private $isMailConfigFound = true;

    private $logPath = "";

    private $configPath = "";


    /**
     * Intialize the Mail Configeration
     * @return unknown_type
     */
    public function __construct()
    {

        $this->logPath = ROOT_PATH . '/lib/logs/';
        $this->configPath = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'confs'.DIRECTORY_SEPARATOR.'mailConf.php';

        if(is_file($this->configPath))
        {
            include_once($this->configPath);
        }
        else
        {
            $this->isMailConfigFound = false;
            $this->logError("ERROR => Configuration file not found");
        }

        require_once sfConfig::get('sf_root_dir').'/lib/vendor/swift/lib/swift_required.php';

        $this->message	=	Swift_Message::newInstance();

    }

    /** Get Swift Mailler according to configeration
     *
     * @return Swift Mailer
     */
    private function getSwiftMailer()
    {
        switch($this->mailType)
        {
            case 'smtp':
                $transport = Swift_SmtpTransport::newInstance($this->smtpHost,$this->smtpPort);

                $authType = $this->smtpAuth;
                if( $authType != self::EMAILCONFIGURATION_SMTP_AUTH_NONE )
                {
                    $transport->setUsername($this->smtpUser);
                    $transport->setPassword($this->smtpPass);
                }

                $security = $this->smtpSecurity;
                if ($security != self::EMAILCONFIGURATION_SMTP_SECURITY_NONE)
                {
                    $transport->setEncryption(strtolower($security));
                }
                $mailer = Swift_Mailer::newInstance($transport);

                break;

            case 'sendmail':
                $transport = Swift_SendmailTransport::newInstance($this->sendmailPath );
                $mailer    = Swift_Mailer::newInstance($transport);
                break;

            default:
                $this->logError( "====================\nERROR => Neither SMTP nor SENDMAILER found in the settings");
                $this->logError( $this->message . "\n==========================");
                $transport = Swift_MailTransport::newInstance();

                //Create the Mailer using your created Transport
                $mailer = Swift_Mailer::newInstance($transport);



        }
        return $mailer;
    }


    /**
     * Send Mail
     * @return unknown_type
     */
    public function sendMail()
    {
        $logMessage = "";
        try
        {
            //mail configuration is not found
            if(!$this->isMailConfigFound)
            {
                return true;
            }

            $logMessage =  date('r')." Sending {$this->message->getSubject()} =>";

            if( count($this->message->getTo()) > 0)
            {
                $mailer = $this->getSwiftMailer();
                $this->setFrom(array($this->mailAddress =>'OrangeHRM'));
                $mailer->send($this->message);

                $logMessage .= "\t".implode(' | ',array_keys($this->message->getTo()));
                $this->logError($logMessage);
            }
            else
            {
                $this->logError($logMessage. "No Receipient found");
            }
            return true ;
        }
        catch (Swift_RfcComplianceException $e)
        {
            $this->logError($e->getMessage());
        }
        catch (Exception $e)
        {
            $this->logError($e->getMessage());
        }
    }

    /**
     * Set Mail Subject
     */
    public function setSubject( $subject )
    {
        $this->message->setSubject( $subject );
    }

    /**
     * Set Mail Body
     * @return unknown_type
     */
    public function setMailBody( $mailBody )
    {
        $this->message->setBody( $mailBody );
    }

    /**
     * Set To address
     * @return unknown_type
     */
    public function setTo( $mailTo )
    {
        $this->message->setTo( $mailTo );
    }

    /**
     * Mail from address
     * @param $mailFrom
     * @return unknown_type
     */
    public function setFrom( $mailFrom = array())
    {
        $this->message->setFrom( $mailFrom );
    }

    /**
     * Get message
     */
    public function getMessage( )
    {
        return $this->message;
    }

    public function logError($message)
    {
        error_log($message."\r\n\n", 3, $this->logPath."notification_mails.log");
    }

    public function checkValidEmails($emails, $debugErrorMessage)
    {

        if(empty ($emails)){
            $this->logError(date('r'). "\t" . $debugErrorMessage . " ERROR " ." => Empty email set found");
            return false;
        }

        $emailArr = array();
        $errorEmailArr = array();
        foreach ($emails as $email)
        {
            if(preg_match("/^[^@]*@[^@]*\.[^@]*$/", $email))
            {
                $emailArr[] = $email;
            }
            else{
                $errorEmailArr[] = $email;
            }
            
        }

        if(!empty($errorEmailArr)){
            $this->logError(date('r'). "\t" . $debugErrorMessage . " ERROR " ." => Invalid email set found [ " . implode( " | ", $errorEmailArr) . " ]");
            return false;
        }

        if(empty($emailArr)) return false;
        return $emailArr;

    }

    

}