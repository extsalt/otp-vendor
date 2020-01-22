<?php

namespace Extsalt\Otp\Vendors;

use Extsalt\Otp\MessageVendor;
use GuzzleHttp\Client as GuzzleClient;

class Msg91 extends MessageVendor
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->authKey = config('sms.MSG91_AUTH_KEY');
        $this->senderId = config('sms.MSG91_SENDER_ID');
        $this->route = '4';
        $this->country = '91';
        $this->unicode = 1;
        $this->guzzle = new GuzzleClient(["base_uri" => "https://control.msg91.com/api/"]);
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

        return $this->guzzle->request('GET', 'sendhttp.php', ['query' => $data]);
    }

    /**
     * Prepare base payload
     *
     * @return array|void
     */
    public function prepareBasePayload()
    {
        return ['sender' => $this->senderId,
            'route' => $this->route,
            'authkey' => $this->authKey,
            'unicode' => $this->unicode,
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
        $payload['message'] = urlencode($message);
        $payload['mobiles'] = is_array($recipients) ? implode(',', $recipients) : $recipients;

        return $payload;
    }
}
