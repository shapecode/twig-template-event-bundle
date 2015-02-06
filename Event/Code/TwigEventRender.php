<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

/**
 * Class TwigEventRender
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Code
 * @author Nikita Loges
 * @date 19.01.2015
 */
class TwigEventRender extends TwigEventCode
{

    /** @var int */
    protected $controller;

    /** @var array */
    protected $attributes;

    /** @var array */
    protected $query;

    /** @var string */
    protected $strategy;

    /**
     * @param string $controller
     * @param array $attributes
     * @param int $priority
     * @param array $query
     * @param string $strategy
     */
    public function __construct($controller, array $attributes = array(), $priority = 0, array $query = array(), $strategy = 'inline')
    {
        parent::__construct($priority);

        $this->controller = $controller;
        $this->attributes = $attributes;
        $this->query = $query;
        $this->strategy = $strategy;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes = array())
    {
        $this->attributes = $attributes;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param array $query
     */
    public function setQuery(array $query = array())
    {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param string $strategy
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }
}
