<?php

namespace BonoMail\Transport;

use BonoMail\Transport;
use BonoMail\Message;

class SMTPTransport extends Transport
{

    protected $options;

    protected $mailer;

    public function __construct($options)
    {
        $this->options = $options;

    }

    public function getMailer()
    {
        if (is_null($this->mailer)) {
            $transport = \Swift_SmtpTransport::newInstance($this->options['host'], $this->options['port']);
            $this->mailer = \Swift_Mailer::newInstance($transport);
        }

        return $this->mailer;
    }

    public function send($message)
    {
        return $this->getMailer()->send($message->getMessage());
    }
}
