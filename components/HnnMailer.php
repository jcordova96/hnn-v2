<?php
/**
 * User: DatornData jb@datorndata.com
 * Date: 7/12/13
 * Time: 10:22 AM
 */
/**
 * @property SwiftMailer $oSwiftMailer
 */
class HnnMailer
{

    //help http://www.yiiframework.com/extension/swiftmailer/
    private $mailHost;
    private $mailPort;
    private $sUsername;
    private $sPassword;
    private $sFrom;
    private $transport;
    private $oSwiftMailer;
    private $mailer;
    public $message;

    public function __construct()
    {
        // Get mailer
        $this->oSwiftMailer = Yii::app()->swiftMailer;

        // Get config
        $this->mailHost = Yii::app()->params['mailHost'];
        $this->mailPort = Yii::app()->params['mailPort']; // Optional
        $this->sUsername = Yii::app()->params['mailboxUsername'];
        $this->sPassword = Yii::app()->params['mailboxPassword'];
        $this->sFrom = $this->sUsername;


        // New transport
        $this->transport = $this->oSwiftMailer->smtpTransport($this->mailHost, $this->mailPort);
        $this->transport->setUsername($this->sUsername);
        $this->transport->setPassword($this->sPassword);

        // Mailer
        $this->mailer = $this->oSwiftMailer->mailer($this->transport);
    }

    public function sendMail($sTo, $sSubject, $txtBody)
    {

        $this->message = $this->oSwiftMailer
            ->newMessage($sSubject)
            ->setFrom(array($this->sFrom => Yii::app()->params['mailFromLabel'])) //array('from@example.com' => 'Example Name')
            ->setTo(array($sTo => 'recipient')) //array('recipient@example.com' => 'Recipient Name')
            ->addPart($txtBody, 'text/html') // html version
            ->setBody($txtBody);

        // Send mail
        $result = $this->mailer->send($this->message);

        /*
         * An integer is returned which includes the number of successful recipients.
         * If none of the recipients could be sent to then zero will be returned, which equates to a boolean false.
         * If you set two To: recipients and three Bcc: recipients in the message and all of the recipients are
         * delivered to successfully then the value 5 will be returned.
         * */
        return $result;
    }

}