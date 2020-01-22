<?php

namespace Extsalt\Otp\Test\Unit;

use Extsalt\Otp\Facades\SMS;
use Extsalt\Otp\Vendors\Msg91;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class Msg91Test extends \Extsalt\Otp\Test\Unit\TestCase
{
    use RefreshDatabase;

    /** @test */
    public function instance_test()
    {
        $msg = new Msg91();

        $this->assertInstanceOf(Msg91::class, $msg);
    }


    /** @test
     * @throws \Exception
     */
    public function send_msg_test()
    {
        $response = Msg91::send('xxxxxxxxxx', 'hello world');

        $status = $response->getStatusCode() === 200;

        $this->assertEquals($status, 200);
    }

    /** @test
     * @throws \Exception
     */
    public function send_msg_via_facades_test()
    {
        DB::table('settings')->insert([
            'key' => 'sms_vendor',
            'value' => 'msg91'
        ]);

        $response = SMS::message("xxxxxxxxx", 'hello world');

        $status = $response->getStatusCode() === 200;

        $this->assertEquals(200, $status);
    }

}