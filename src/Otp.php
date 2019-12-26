<?php

namespace Extsalt\Otp;

use Illuminate\Support\Facades\DB;

class Otp
{
    public static function to($phone)
    {
        $setting = DB::table('settings')->where('key', 'otp')->first();

        if (!$setting) {
            throw new \Exception('Opt vendor description is not present in settings table');
        }

        return OtpVendorBuilder::build($setting->value, $phone);
    }

    public static function generate()
    {
        return mt_rand(99999, 100000);
    }
}
