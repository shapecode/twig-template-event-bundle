<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

/**
 * Interface TwigEventCodeInterface
 *
 * @author Nikita Loges
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

    /**
     * @return int
     */
    public function getHandlerName();
}
