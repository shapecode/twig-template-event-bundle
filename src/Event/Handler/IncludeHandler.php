<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventInclude;

/**
 * Class IncludeHandler
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler
 * @author  Nikita Loges
 */
class IncludeHandler implements HandlerInterface
{

    /**
     * @inheritDoc
     *
     * @param TwigEventInclude $code
     */
    public function handle(TwigEventCodeInterface $code, \Twig_Environment $env, array $context = [])
    {
        return $env->resolveTemplate($code->getTemplate())->render(array_replace_recursive($context, $code->getParameters()));
    }
}
