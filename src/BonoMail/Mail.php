<?php

namespace BonoMail;

class Mail
{
    public static $transports = array();

    public static $defaultTransport = '';

    public static $options = array();

    protected static $aliases = array(
        'smtp' => '\\BonoMail\\Transport\\SMTPTransport',
    );

    public static function init($options)
    {
        static::$options = $options;

        if (empty($options['transports'])) {
            $options['transports'] = array(
                'default' => array(
                    'driver' => 'smtp',
                    'host' => 'localhost',
                    'port' => 25,
                ),
            );
        }

        $first = '';
        foreach ($options['transports'] as $key => $value) {
            $value['name'] = $key;

            if (!isset($value['driver'])) {
                throw new \Exception(
                    '[Norm] Cannot instantiate transport "'.$key.
                    '", Driver "'.@$value['driver'].'" not found!'
                );
            } elseif (isset(static::$aliases[$value['driver']])) {
                $value['driver'] = static::$aliases[$value['driver']];
            }

            $Driver = $value['driver'];

            static::$transports[$key] = new $Driver($value);
            if (!static::$transports[$key] instanceof Transport) {
                throw new \Exception('BonoMail transport ['.$key.'] should be instance of Transport');
            }

            if (!$first) {
                $first = $key;
            }
        }

        if (!static::$defaultTransport) {
            static::$defaultTransport = $first;
        }
    }

    public static function getTransport($transportName = '')
    {
        if (!$transportName) {
            $transportName = static::$defaultTransport;
        }

        if (isset(static::$transports[$transportName])) {
            return static::$transports[$transportName];
        }
    }

    public static function __callStatic($method, $parameters)
    {
        $transport = static::getTransport();
        if ($transport) {
            return call_user_func_array(array($transport, $method), $parameters);
        } else {
            throw new \Exception("[BonoMail] No transport exists.");
        }
    }
}
