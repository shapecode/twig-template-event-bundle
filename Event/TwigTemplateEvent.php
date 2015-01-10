<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class TwigTemplateEvent
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event
 * @author Nikita Loges
 * @date 10.01.2015
 */
class TwigTemplateEvent extends Event
{

    /**
     * @var string
     */
    public $eventName;

    /**
     * @var array
     */
    public $codes;

    /**
     * @param $eventName
     */
    public function __construct($eventName)
    {
        $this->eventName = $eventName;
        $this->codes = array();
    }

    /**
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @param string $code
     */
    public final function addCode($code)
    {
        $this->codes[] = $code;
    }

    /**
     * @return array
     */
    public function getCodes()
    {
        return $this->codes;
    }
}