<?php

namespace BonoMail;

use Bono\App;

class Message
{

    protected $message;

    public function __construct($subject = null)
    {
        $this->message = \Swift_Message::newInstance();

        if (isset(Mail::$options['defaultMessage'])) {
            foreach (Mail::$options['defaultMessage'] as $key => $value) {
                if (is_callable(array($this, $key))) {
                    $this->$key($value);
                }
            }
        }

        if (!is_null($subject)) {
            $this->subject($subject);
        }
    }

    public function subject($subject = null)
    {
        if (func_num_args() === 0) {
            return $this->message->getSubject();
        }

        $this->message->setSubject($subject);
        return $this;
    }

    public function from($from = null)
    {
        if (func_num_args() === 0) {
            return $this->message->getFrom();
        }

        $this->message->setFrom($from);

        return $this;
    }

    public function to($to = null)
    {
        if (func_num_args() === 0) {
            return $this->message->getTo();
        }

        $this->message->setTo($to);

        return $this;
    }


    public function body($template = null, $data = null)
    {
        if (func_num_args() === 0) {
            return $this->message->getBody();
        }

        if (is_string($template)) {
            $this->message->setBody(App::getInstance()->theme->partial('emails/'.$template, $data));
        } else {
            throw new \Exception('Unimplemented yet!');
        }

        return $this;
    }

    public function send()
    {
        return $this->transport->send($this);
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function transport($transport = null)
    {
        if (func_num_args() === 0) {
            return $this->transport;
        }

        $this->transport = $transport;

        return $this;
    }
}
