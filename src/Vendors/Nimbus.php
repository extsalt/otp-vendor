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
     */
    public function __construct()
    {
        $this->authKey = config('sms.NIMBUS_AUTH_KEY');
        $this->senderId = config('sms.NIMBUS_SENDER_ID');
        $this->userId = config('sms.NIMBUS_USER_ID');
        $this->guzzle = new GuzzleClient(["base_uri" => "http://nimbusit.info/api/"]);
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

        $response = $this->guzzle->request('GET', 'pushsms.php', ['query' => $data]);

        return $this->parseResponse($response->getBody()->getContents());
    }

    /**
     * Prepare base payload
     *
     * @return array|void
     */
    public function prepareBasePayload()
    {
        return ['sender' => $this->senderId,
            'key' => $this->authKey,
            'user' => $this->userId,
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
    public function mergeBasePayload($recipients, $message)
    {
        if ((strlen($message) > 160))
            throw new \Exception('Message should not exceed 160 characters in length');

        $payload = $this->prepareBasePayload();
        $payload['text'] = $message;
        $payload['mobile'] = is_array($recipients) ? implode(',', $recipients) : $recipients;

        return $payload;
    }

    /**
     * Parse response
     *
     * @param $response
     * @return bool|void
     */
    public function parseResponse($response)
    {
        $splinters = explode(',', $response);

        return abs($splinters[0]) === 100;
    }
}
