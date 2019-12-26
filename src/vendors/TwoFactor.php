<?php

namespace Extsalt\Otp\Vendors;

use Extsalt\Otp\OtpContract;

class TwoFactor implements OtpContract
{
    private $phone;

    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Send otp
     *
     * @param $message
     * @return mixed
     */
    function send($message)
    {
        echo "$message is being sent to $this->phone by 2factor";
    }
}