<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

/**
 * Class TwigEventCode
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Code
 * @author  Nikita Loges
 */
abstract class TwigEventCode implements TwigEventCodeInterface
{

    /** @var int */
    protected $priority;

    /**
     * @param int $priority
     */
    public function __construct($priority = 0)
    {
        $this->priority = (int)$priority;
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @inheritdoc
     */
    public function setPriority($priority)
    {
        $this->priority = (int)$priority;
    }
}
