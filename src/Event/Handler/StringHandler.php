<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventString;

/**
 * Class StringHandler
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler
 * @author  Nikita Loges
 */
class StringHandler implements HandlerInterface
{

    /**
     * @inheritdoc
     *
     * @param TwigEventString $code
     */
    public function handle(TwigEventCodeInterface $code, \Twig_Environment $env, array $context = [])
    {
        $parameters = array_replace_recursive($context, $code->getParameters());

        return $env->render($code->getTemplateString(), $parameters);
    }

}
