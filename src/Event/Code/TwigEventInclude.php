<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

/**
 * Class TwigEventInclude
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Code
 * @author  Nikita Loges
 */
class TwigEventInclude extends TwigEventCode
{

    /** @var string */
    protected $template;

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

        $this->template = $templateString;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
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
        return 'shapecode_twig_template_event.event_handler.include';
    }
}
