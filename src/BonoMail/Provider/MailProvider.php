<?php

namespace BonoMail\Provider;

use Bono\Provider\Provider;
use BonoMail\Mail;

class MailProvider extends Provider
{
    public function initialize()
    {
        Mail::init($this->options);
    }
}
