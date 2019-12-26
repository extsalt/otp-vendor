<?php


namespace Extsalt\Otp;

interface OtpContract
{
    /**
     * Send otp
     *
     * @param $message
     * @return mixed
     */
    function send($message);
}