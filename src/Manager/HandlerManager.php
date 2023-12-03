<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Manager;

use RuntimeException;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;

use function array_key_exists;
use function sprintf;

class HandlerManager
{
    /** @var array<string, HandlerInterface<TwigEventCodeInterface>> */
    protected array $handlers = [];

    /** @param HandlerInterface<TwigEventCodeInterface> $handler */
    public function addHandler(HandlerInterface $handler): void
    {
        $name = $handler::class;

        if (array_key_exists($name, $this->handlers)) {
            throw new RuntimeException(sprintf('handler %s already exists', $name), 1596984981559);
        }

        $this->handlers[$name] = $handler;
    }

    /** @return HandlerInterface<TwigEventCodeInterface> */
    public function getHandler(string $name): HandlerInterface
    {
        if (! array_key_exists($name, $this->handlers)) {
            throw new RuntimeException(sprintf('handler %s not found', $name), 1596984726680);
        }

        return $this->handlers[$name];
    }
}
