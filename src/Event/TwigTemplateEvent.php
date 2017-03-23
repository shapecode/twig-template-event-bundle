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
 */
class TwigTemplateEvent extends Event
{

    const DEPRECATED = 'twig.template.event';
    const PREFIX = 'shapecode.twig_template';
    const TEMPLATE_EVENT = 'shapecode.twig_template.event';

    /** @var array */
    private $parameters;

    /** @var array */
    private $context;

    /** @var string */
    protected $eventName;

    /** @var RequestStack */
    protected $request;

    /** @var TwigEventCodeInterface[] */
    protected $codes;

    /**
     * @param              $eventName
     * @param array        $context
     * @param array        $parameters
     * @param RequestStack $request
     */
    public function __construct($eventName, array $context = [], array $parameters = [], RequestStack $request)
    {
        $this->eventName = $eventName;
        $this->context = $context;
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
     * @return array
     */
    public function getContext()
    {
        return $this->context;
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
        $this->codes[] = $code;
    }

    /**
     * @return TwigEventCodeInterface[]
     */
    public function getCodes()
    {
        return $this->codes;
    }
}
