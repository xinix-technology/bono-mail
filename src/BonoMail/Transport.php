<?php

namespace BonoMail;

abstract class Transport
{
    public function factory($subject)
    {
        $message = new Message($subject);
        return $message->transport($this);
    }

    abstract public function send($message);
}
