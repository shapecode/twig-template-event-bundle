<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Services;

/**
 * Interface EventServiceInterface
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Services
 * @author  Nikita Loges
 */
interface EventServiceInterface
{

    /**
     * @param       $context
     * @param       $name
     * @param array $parameters
     *
     * @return string
     */
    public function handleEvent($name, array $parameters = [], array $context = []);
}
