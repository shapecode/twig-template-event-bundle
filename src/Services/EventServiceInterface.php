<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Services;

use Twig\Environment;

/**
 * Interface EventServiceInterface
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Services
 * @author  Nikita Loges
 */
interface EventServiceInterface
{

    /**
     * @param                   $name
     * @param Environment       $environment
     * @param array             $parameters
     * @param array             $context
     *
     * @return mixed
     */
    public function handleEvent($name, Environment $environment, array $parameters = [], array $context = []);
}
