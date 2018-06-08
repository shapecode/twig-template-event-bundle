<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Twig\Environment;

/**
 * Interface HandlerInterface
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler
 * @author  Nikita Loges
 */
interface HandlerInterface
{

    /**
     * @param TwigEventCodeInterface $code
     * @param Environment            $env
     * @param array                  $context
     *
     * @return string
     */
    public function handle(TwigEventCodeInterface $code, Environment $env, array $context = []);

}
