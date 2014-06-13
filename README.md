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

TBD
