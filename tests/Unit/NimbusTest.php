<?php

namespace Extsalt\Otp\Test\Unit;


use Extsalt\Otp\Vendors\Nimbus;
use Illuminate\Support\Facades\Config;

class NimbusTest extends \Extsalt\Otp\Test\Unit\TestCase
{
    /** @test */
    public function nimbus_instance_test()
    {
        $msg = new Nimbus();

        $this->assertInstanceOf(Nimbus::class, $msg);
    }

    /** @test */
    public function nimbus_credentials_test()
    {
        $msg = new Nimbus();

        $this->assertIsArray($msg->prepareBasePayload());
    }

    /** @test
     * @throws \Exception
     */
    public function nimbus_msg_test()
    {
        $response = Nimbus::send('xxxxxxxxxx', "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");

        $this->assertTrue($response);
    }
}