<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Event;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class TwigTemplateEvent
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event
 * @author  Nikita Loges
 * @date    10.01.2015
 */
class TwigTemplateEvent extends Event
{

    /** @var array */
    private $parameters;

    /** @var string */
    protected $eventName;

    /** @var RequestStack */
    protected $request;

    /** @var TwigEventCodeInterface[] */
    protected $codes;

    /**
     * @param $eventName
     * @param array $parameters
     * @param RequestStack $request
     */
    public function __construct($eventName, array $parameters = [], RequestStack $request)
    {
        $this->eventName = $eventName;
        $this->parameters = $parameters;
        $this->codes = [];
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
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
     * @param TwigEventCodeInterface $code
     */
    public function addCode(TwigEventCodeInterface $code)
    {
        usort($this->codes, function (TwigEventCodeInterface $a, TwigEventCodeInterface $b) {
            /** @var TwigEventCodeInterface $a */
            /** @var TwigEventCodeInterface $b */
            if ($a->getPriority() == $b->getPriority()) {
                return 0;
            }

            return ($a->getPriority() < $b->getPriority()) ? -1 : 1;
        });

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
