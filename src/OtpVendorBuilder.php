<?php

namespace Extsalt\Otp;

use Extsalt\Otp\Vendors\Nexmo;
use Extsalt\Otp\Vendors\TwoFactor;

class OtpVendorBuilder
{
    /**
     * List of supported vendor list
     *
     * @var array
     */
    private static $vendors = [
        'nexmo' => Nexmo::class,
        '2factor' => TwoFactor::class
    ];

    /**
     * Build vendor class
     *
     * @param $vendor
     * @param $phone
     * @return OtpContract
     * @throws \Exception
     */
    public static function build($vendor, $phone): OtpContract
    {
        if (array_key_exists($vendor, static::$vendors)) {
            return new static::$vendors[$vendor]($phone);
        }

        throw  new \Exception('Vendor mentioned in settings table for setting otp is not supported.');
    }
}