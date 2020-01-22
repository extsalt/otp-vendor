<?php

namespace Extsalt\Otp\Test\Unit;

use Extsalt\Otp\SMSVendorBuilder;

class OtpVendorBuilderTest extends \Extsalt\Otp\Test\Unit\TestCase
{
    /** @test */
    public function vendor_array_test()
    {
        $this->assertIsArray(SMSVendorBuilder::getVendors());
    }
}