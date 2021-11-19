<?php

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function test_truth()
    {
        $this->assertNotTrue('true' === 'false');
    }
}
