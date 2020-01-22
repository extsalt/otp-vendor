<?php

namespace Extsalt\Otp\Vendors;

use Extsalt\Otp\MessageVendor;
use GuzzleHttp\Client as GuzzleClient;

class Nimbus extends MessageVendor
{
    /**
     * Constructor
     *
     * @return void
     *
     */
    public function __construct()
    {
        $this->authKey = config('sms.NIMBUS_AUTH_KEY');
        $this->senderId = config('sms.NIMBUS_SENDER_ID');
        $this->userId = config('sms.NIMBUS_USER_ID');
        $this->guzzle = new GuzzleClient(["base_uri" => "http://nimbusit.info/api/"]);
        $this->route = '4';
        $this->country = '91';
        $this->unicode = 1;
    }

    /**
     * Send an SMS to one or more numbers
     *
     * @param $recipients
     * @param string $message The message to be sent
     * @return string JSON encoded string of the
     *
     * @throws \Exception
     */
    public function message($recipients, $message)
    {
        $data = $this->mergeBasePayload($recipients, $message);

        return $this->guzzle->request('GET', 'pushsms.php', ['query' => $data]);
    }

    /**
     * Prepare base payload
     *
     * @return array|void
     */
    public function prepareBasePayload()
    {
        return ['sender' => urldecode($this->senderId),
            'route' => $this->route,
            'key' => $this->authKey,
            'unicode' => $this->unicode,
            'user' => $this->userId,
            'country' => $this->country
        ];
    }

    /**
     * Merge base payload with message
     *
     * @param $message
     * @param $recipients
     * @return array|void
     * @throws \Exception
     */
    public function mergeBasePayload($message, $recipients)
    {
        if ((strlen($message) > 160))
            throw new \Exception('Message should not exceed 160 characters in length');

        $payload = $this->prepareBasePayload();
        $payload['text'] = urlencode($message);
        $payload['mobile'] = is_array($recipients) ? implode(',', $recipients) : $recipients;

        return $payload;
    }
}
