<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Manager;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;

/**
 * Interface HandlerManagerInterface
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Manager
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface HandlerManagerInterface
{

    /**
     * @param                  $id
     * @param HandlerInterface $handler
     */
    public function addHandler($id, HandlerInterface $handler);

    /**
     * @param $name
     *
     * @return HandlerInterface|null
     */
    public function getHandler($name);
}
