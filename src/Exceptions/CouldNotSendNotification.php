<?php

namespace Kineticamobile\Ubicual\Exceptions;

use Kineticamobile\Ubicual\UbicualMessage;

class CouldNotSendNotification extends \Exception
{
    /**
     * @return static
     */
    public static function invalidCredentials()
    {
        return new static('Invalid credentials');
    }

    /**
     * @return static
     */
    public static function invalidReceiver()
    {
        return new static('The notifiable did not have a phone number. Add routeNotificationForUbicual to your notifiable');
    }

    /**
     * @return static
     */
    public static function missingFrom()
    {
        return new static('Notification was not sent. Missing `from` number.');
    }


    /**
     * @param $message
     * @return static
     */
    public static function invalidMessageObject($message)
    {
        $className = get_class($message) ?: 'Unknown';

        return new static(
            'Notification was not sent. Message object class '.$className.
            ' is invalid. It should be '.UbicualMessage::class
        );
    }
}
