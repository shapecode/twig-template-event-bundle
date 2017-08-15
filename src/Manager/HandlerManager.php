<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;

/**
 * Class HandlerManager
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Manager
 * @author  Nikita Loges
 */
class HandlerManager implements HandlerManagerInterface
{

    /** @var ArrayCollection|HandlerInterface[] */
    protected $handlers;

    /**
     *
     */
    public function __construct()
    {
        $this->handlers = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|HandlerInterface[]
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * @inheritdoc
     */
    public function addHandler($id, HandlerInterface $handler)
    {
        $this->getHandlers()->set($id, $handler);
    }

    /**
     * @inheritdoc
     */
    public function getHandler($name)
    {
        if (!$this->hasHandler($name)) {
            throw new \RuntimeException('handler ' . $name . ' nout found');
        }

        return $this->getHandlers()->get($name);
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function hasHandler($name)
    {
        return $this->getHandlers()->containsKey($name);
    }
}
