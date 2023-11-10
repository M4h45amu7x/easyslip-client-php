<?php

namespace M4h45amu7x;

use PHPUnit\Framework\TestCase;
use M4h45amu7x\EasySlip;

class EasySlipTest extends TestCase
{
    public function testVerifyฺByPayload()
    {
        $slip = new EasySlip('TEST');
        $result = $slip->verifyByPayload('TEST');

        $this->assertEquals(200, $result['status']);
    }

    public function testVerifyฺByImage()
    {
        $slip = new EasySlip('TEST');
        $result = $slip->verifyByImage('test/images/qrcode.jpg');

        $this->assertEquals(200, $result['status']);
    }
}
