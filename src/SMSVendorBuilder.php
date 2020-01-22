<?php

namespace Extsalt\Otp;

use Extsalt\Otp\Vendors\Msg91;
use Extsalt\Otp\Vendors\Nimbus;

class SMSVendorBuilder
{
    /**
     * List of supported vendor list
     *
     * @var array
     */
    private static $vendors = [
        'nimbus' => Nimbus::class,
        'msg91' => Msg91::class
    ];

    /**
     * Build vendor instance
     *
     * @return mixed
     * @throws \Exception
     */
    public static function build()
    {
        $record = \DB::table('settings')->where('key', 'sms_vendor')->first();

        if (is_null($record)) {
            throw  new \Exception("SMS Vendor is not set.");
        }

        if (array_key_exists($record->value, static::getVendors())) {
            return new static::$vendors[$record->value]();
        }

        throw  new \Exception(
            'SMS Vendor mentioned in settings table for setting 
            otp is not supported.'
        );
    }

    /**
     * Get vendors
     *
     * @return array
     */
    public static function getVendors(): array
    {
        return self::$vendors;
    }
}