<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

abstract class TwigEventCode implements TwigEventCodeInterface
{
    /** @var int */
    private $priority;

    public function __construct(int $priority = 0)
    {
        $this->priority = $priority;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }
}
