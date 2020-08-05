<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Manager;

use RuntimeException;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;

use function array_key_exists;
use function get_class;
use function sprintf;

class HandlerManager implements HandlerManagerInterface
{
    /** @var HandlerInterface[] */
    protected $handlers = [];

    public function addHandler(HandlerInterface $handler): void
    {
        $this->handlers[get_class($handler)] = $handler;
    }

    public function getHandler(string $name): HandlerInterface
    {
        if (! array_key_exists($name, $this->handlers)) {
            throw new RuntimeException(sprintf('handler %s not found', $name));
        }

        return $this->handlers[$name];
    }
}
