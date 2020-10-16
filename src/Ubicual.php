<?php

namespace Kineticamobile\Ubicual;

use Kineticamobile\Ubicual\Exceptions\CouldNotSendNotification;
use Illuminate\Support\Facades\Http;

class Ubicual
{
    /**
     * @var UbicualConfig
     */
    public $config;

    /**
     * @var UbicualMessage
     */
    public $message;

    /**
     * Ubicual constructor.
     *
     * @param UbicualMessage $message
     * @param UbicualConfig $config
     */
    public function __construct(UbicualMessage $message, UbicualConfig $config)
    {
        $this->config = $config;
        $this->message = $message;
    }

    /**
     * Send sms message to recipient.
     *
     * @param UbicualMessage $message
     * @param $recipient
     * @throws CouldNotSendNotification
     */
    public function sendMessage(UbicualMessage $message, $recipient)
    {
        if ($message instanceof UbicualMessage) {
            $message->from($this->config->getFrom());
            $response=$this->sendSms($message, $recipient);

            if($response->ok()){
                return $response->status();
            }
        }

        throw CouldNotSendNotification::invalidMessageObject($message);
    }

    /**
     * Send sms message to recipient using Ubicual SMSTextualRequest.
     *
     * @param UbicualMessage $message
     * @param $recipient
     */
    public function sendSms(UbicualMessage $message, $recipient)
    {

        $response = Http::get($this->config->config['base_url'], [
            'to' => $recipient,
            'from' => $this->getFrom($message),
            'text' =>$message->content,
            'api_token' => $this->config->config['api_token'],
        ]);

        return $response;
    }

    /**
     * Get message from phone number from message or config.
     *
     * @param UbicualMessage $message
     * @return mixed
     * @throws CouldNotSendNotification
     */
    public function getFrom(UbicualMessage $message)
    {
        if (! $from = $message->from ?: $this->config->config['from']) {
            throw CouldNotSendNotification::missingFrom();
        }

        return $message->from ?: $this->config->config['from'];
    }


}
