<?php

namespace Kineticamobile\Ubicual\Events;

use Illuminate\Notifications\Notification;

class NotificationSent
{
    protected $notifiable;

    protected $notification;

    /**
     * @param $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     */
    public function __construct($notifiable, Notification $notification)
    {
        $this->notifiable = $notifiable;
        $this->notification = $notification;
    }
}
