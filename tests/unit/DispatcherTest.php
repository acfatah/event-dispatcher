<?php

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
    public function createDispatcher($listeners = [])
    {
        return new Acfatah\EventDispatcher\Dispatcher($listeners);
    }

    public function testConstructorMethod()
    {
        $dispatcher = $this->createDispatcher([
            'increment' => function ($event) {
                $event->getSender()->counter++;
            }
        ]);

        $this->assertHasAndResetMethod($dispatcher);
    }

    public function testAddMethod()
    {
        $callback = function ($event) {
            $event->getSender()->counter++;
        };

        $dispatcher = $this->createDispatcher();
        $dispatcher->add('increment', $callback);

        $this->assertHasAndResetMethod($dispatcher);
    }

    public function assertHasAndResetMethod($dispatcher)
    {
        $sender = new stdClass;
        $sender->counter = 0;

        $dispatcher->dispatch(new Acfatah\EventDispatcher\Event('increment', $sender));

        $this->assertTrue($dispatcher->has('increment'));
        $this->assertEquals(1, $sender->counter);

        $dispatcher->reset('increment');
        $this->assertFalse($dispatcher->has('increment'));
    }
}
