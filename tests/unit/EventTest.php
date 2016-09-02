<?php

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testSenderNotObject()
    {
        $this->expectException('Acfatah\EventDispatcher\RuntimeException');

        $event = new Acfatah\EventDispatcher\Event('foo', 'a string');
    }
}
