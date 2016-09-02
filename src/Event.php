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

use Acfatah\EventDispatcher\RuntimeException;

/**
 * Encapsulates an event.
 *
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */
class Event
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var object
     */
    protected $sender;

    /**
     * Constructor.
     *
     * @param string $name
     * @param object $sender
     * @throws Acfatah\EventDispatcher\RuntimeException
     */
    public function __construct($name, $sender)
    {
        $this->name = $name;
        if (!is_object($sender)) {
            throw new RuntimeException('Sender is not an object instance!');
        }
        $this->sender = $sender;
    }

    /**
     * Gets the event name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the sender instance.
     *
     * @return object
     */
    public function getSender()
    {
        return $this->sender;
    }
}
