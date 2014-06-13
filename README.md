bono-mail
=========

Mailer for Bono

Its simply thin wrapper to SwiftMailer now.

With bono-mail you can utilize bono configuration to bootstrap your mailer.

# Installlation

```
composer require xinix-technology/bono-mail
```

# Configuration

Edit config/config.php

```php

return array(
    'bono.providers' => array(
        // ...
        '\\BonoMail\\Provider\\MailProvider' => array(
            'defaultMessage' => array(
                'from' => array('john@doe.com' => 'John Doe'),
            ),
            'transports' => array(
                'smtp' => array(
                    'driver' => 'smtp',
                    'host' => 'localhost',
                    'port' => 25,
                ),
            ),
        ),
        // ...
    ),
);


```

# Howto Use

```php

$result = \BonoMail\Mail::factory('Some subject for you')
    ->body('test', array())
    ->to(array('jane@doe.com'))
    ->send();

```

Above code will send mail to jane@doe.com from default from (from configuration)
with body from emails/test template.
