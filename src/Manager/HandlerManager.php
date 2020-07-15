<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use RuntimeException;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;

class HandlerManager implements HandlerManagerInterface
{
    /** @var ArrayCollection|HandlerInterface[] */
    protected $handlers;

    public function __construct()
    {
        $this->handlers = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|HandlerInterface[]
     */
    public function getHandlers(): ArrayCollection
    {
        return $this->handlers;
    }

    /**
     * @inheritdoc
     */
    public function addHandler(string $id, HandlerInterface $handler): void
    {
        $this->getHandlers()->set($id, $handler);
    }

    /**
     * @inheritdoc
     */
    public function getHandler(string $name): HandlerInterface
    {
        if (! $this->hasHandler($name)) {
            throw new RuntimeException('handler ' . $name . ' nout found');
        }

        return $this->getHandlers()->get($name);
    }

    protected function hasHandler(string $name): bool
    {
        return $this->getHandlers()->containsKey($name);
    }
}
