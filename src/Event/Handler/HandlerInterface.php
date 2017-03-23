<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;

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
     * @param \Twig_Environment      $env
     * @param array                  $context
     *
     * @return string
     */
    public function handle(TwigEventCodeInterface $code, \Twig_Environment $env, array $context = []);

}
