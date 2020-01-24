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
    public function msg91_instance_test()
    {
        $msg = new Msg91();

        $this->assertInstanceOf(Msg91::class, $msg);
    }


    /**  @test */
    public function msg91_credential_test()
    {
//        dd((new Msg91())->prepareBasePayload());
    }

    /** @test
     * @throws \Exception
     */
    public function msg91_send_msg_test()
    {
        $response = Msg91::send(768309600, 'hello world');

//        dd($response->getBody()->getContents());
    }
}