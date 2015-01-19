<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

/**
 * Interface TwigEventCodeInterface
 * @author Nikita Loges
 * @company tenolo GbR
 * @date 19.01.2015
 */
interface TwigEventCodeInterface
{

    /**
     * @return int
     */
    public function getPriority();

    /**
     * @param int $priority
     */
    public function setPriority($priority);
}