<?php

/*
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file.
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright (c) 2016, Achmad F. Ibrahim
 * @link https://github.com/acfatah/event-dispatcher
 * @license http://opensource.org/licenses/mit-license.php The MIT License (MIT)
 */

namespace Acfatah\EventDispatcher;

use Acfatah\EventDispatcher\Event;

/**
 * Event dispatcher class.
 *
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */
class Dispatcher
{
    /**
     * @var callable[]
     */
    protected $listeners = [];

    /**
     * Constructor.
     *
     * @param array $listeners
     */
    public function __construct(array $listeners = [])
    {
        foreach ($listeners as $eventName => $listener) {
            $this->add($eventName, $listener);
        }
    }

    /**
     * Checks whether an event is registered.
     *
     * @param string $eventName
     * @return boolean
     */
    public function has($eventName)
    {
        return isset($this->listeners[$eventName]);
    }

    /**
     * Adds a listener (callback) to an event.
     *
     * @param string $eventName
     * @param callable $listener
     * @return static
     */
    public function add($eventName, callable $listener)
    {
        $this->listeners[$eventName][] = $listener;

        return $this;
    }

    /**
     * Removes all listeners from an event.
     *
     * @param string $eventName
     * @return static
     */
    public function reset($eventName)
    {
        unset($this->listeners[$eventName]);

        return $this;
    }

    /**
     * Dispatches an event instance to all registered listeners.
     *
     * @param Event $event
     * @return static
     */
    public function dispatch(Event $event)
    {
        if ($this->has($event->getName())) {
            foreach ($this->listeners[$event->getName()] as $listener) {
                call_user_func($listener, $event);
            }
        }

        return $this;
    }
}
