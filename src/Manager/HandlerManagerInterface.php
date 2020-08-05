<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Manager;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;

interface HandlerManagerInterface
{
    public function addHandler(HandlerInterface $handler): void;

    public function getHandler(string $name): HandlerInterface;
}
