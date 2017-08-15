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
        $parameters = array_replace_recursive($context, $code->getParameters());
        $template = $env->resolveTemplate($code->getTemplate());

        return $template->render($parameters);
    }
}
