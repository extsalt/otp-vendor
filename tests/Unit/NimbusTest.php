<?php

namespace Extsalt\Otp\Test\Unit;


use Extsalt\Otp\Vendors\Nimbus;

class NimbusTest extends \Extsalt\Otp\Test\Unit\TestCase
{
    /** @test */
    public function instance_test()
    {
        $msg = new Nimbus();

        $this->assertInstanceOf(Nimbus::class, $msg);
    }

    /** @test
     * @throws \Exception
     */
    public function send_msg_test()
    {
        $response = Nimbus::send(9999999999, "hello world hello there");

        $status = $response->getStatusCode() === 200;

        $this->assertEquals($status, 200);
    }
}