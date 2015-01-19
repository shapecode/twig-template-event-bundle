<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

/**
 * Class TwigEventString
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Code
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 19.01.2015
 */
class TwigEventString extends TwigEventCode
{

    /** @var string */
    protected $templateString;

    /** @var array */
    protected $parameters;

    /**
     * @param int $templateString
     * @param array $parameters
     * @param int $priority
     */
    public function __construct($templateString, array $parameters = array(), $priority = 0)
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
    public function setParameters(array $parameters = array())
    {
        $this->parameters = $parameters;
    }
}