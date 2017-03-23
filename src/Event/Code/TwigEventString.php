<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

/**
 * Class TwigEventString
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Code
 * @author  Nikita Loges
 */
class TwigEventString extends TwigEventCode
{

    /** @var string */
    protected $templateString;

    /** @var array */
    protected $parameters;

    /**
     * @param int   $templateString
     * @param array $parameters
     * @param int   $priority
     */
    public function __construct($templateString, array $parameters = [], $priority = 0)
    {
        parent::__construct($priority);

        $this->templateString = $templateString;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getTemplateString()
    {
        return $this->templateString;
    }

    /**
     * @param string $templateString
     */
    public function setTemplateString($templateString)
    {
        $this->templateString = $templateString;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @inheritDoc
     */
    public function getHandlerName()
    {
        return 'shapecode_twig_template_event.event_handler.string';
    }
}
