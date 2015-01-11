<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

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
     * @var RequestStack
     */
    public $request;

    /**
     * @var array
     */
    public $codes;

    /**
     * @param $eventName
     * @param RequestStack $request
     */
    public function __construct($eventName, RequestStack $request)
    {
        $this->eventName = $eventName;
        $this->codes = array();
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request->getCurrentRequest();
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