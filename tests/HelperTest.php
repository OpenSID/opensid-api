<?php

class HelperTest extends TestCase
{
    public function testUrlFotoContainWomen()
    {
        $this->assertStringContainsString(url_foto('', '', 2), config('opensid.host') . 'assets/files/user_pict/wuser.png');
        $this->assertStringContainsString(url_foto('wuser.png'), config('opensid.host') . LOKASI_USER_PICT . 'wuser.png');
    }

    public function testUrlFotoContainMen()
    {
        $this->assertStringContainsString(url_foto('', '', 1), config('opensid.host') . 'assets/files/user_pict/kuser.png');
        $this->assertStringContainsString(url_foto('kuser.png'), config('opensid.host') . LOKASI_USER_PICT . 'kuser.png');
    }
}
