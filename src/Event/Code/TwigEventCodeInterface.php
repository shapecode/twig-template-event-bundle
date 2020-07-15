<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

interface TwigEventCodeInterface
{
    public function getPriority(): int;

    public function setPriority(int $priority): void;

    public function getHandlerName(): string;
}
