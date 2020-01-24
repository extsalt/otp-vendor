<?php

namespace Extsalt\Otp;

abstract class MessageVendor
{
    /**
     * @var string
     */
    protected $userId;

    /**
     * Api Key
     *
     * @var string The API key for access to the Msg91 account
     *
     */
    protected $authKey;

    /**
     * Default from name/number
     *
     * @var string Default name or number that the SMS will be sent from
     *
     */
    protected $senderId;

    /**
     * Default route
     *
     * @var integer text type, 1 for promotional, 4 for transactional
     *
     */
    protected $route;

    /**
     * Guzzle HTTP Client - used to access Txtlocal API
     *
     * @var \GuzzleHttp\Client Instance of the Guzzle Client class
     *
     */
    protected $guzzle;

    /**
     * @var string
     */
    protected $unicode;

    /**
     * @var string
     */
    protected $country;

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
        //
    }

    /**
     * Prepare base payload
     *
     * @return array|void
     */
    public function prepareBasePayload()
    {
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
        //
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static())->message($arguments[0], $arguments[1]);
    }

    /**
     * Parse response
     *
     * @param $response
     */
    public function parseResponse($response)
    {

    }
}