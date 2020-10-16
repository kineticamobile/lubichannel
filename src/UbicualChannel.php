<?php

namespace Kineticamobile\Ubicual;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Notifications\Notification;
use Kineticamobile\Ubicual\Events\NotificationFailed;
use Kineticamobile\Ubicual\Events\NotificationSent;
use Kineticamobile\Ubicual\Exceptions\CouldNotSendNotification;

class UbicualChannel
{
    /**
     * @var Dispatcher
     */
    public $events;

    /**
     * @var Ubicual
     */
    public $ubicual;

    /**
     * UbicualChannel constructor.
     *
     * @param Ubicual $ubicual
     * @param Dispatcher $events
     */
    public function __construct(Ubicual $ubicual, Dispatcher $events)
    {
        $this->events = $events;
        $this->ubicual = $ubicual;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \Kineticamobile\Ubicual\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $recipient = $this->getRecipient($notifiable);
        $message = $notification->toUbicual($notifiable);

        try {
            $response = $this->ubicual->sendMessage($message, $recipient);
            $this->events->dispatch(new NotificationSent($notifiable, $notification));
        } catch (\Exception $exception) {
            $this->events->dispatch(new NotificationFailed($notifiable, $notification, $exception));
        }
    }

    /**
     * Get message recipient.
     *
     * @param $notifiable
     * @return mixed
     * @throws CouldNotSendNotification
     */
    public function getRecipient($notifiable)
    {
        if ($notifiable->routeNotificationFor('ubicual', $notifiable)) {
            return $notifiable->routeNotificationFor('ubicual', $notifiable);
        }

        throw CouldNotSendNotification::invalidReceiver();
    }
}
