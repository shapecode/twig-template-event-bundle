<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventString;
use Twig\Environment;

use function array_replace_recursive;
use function assert;

class StringHandler implements HandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(TwigEventCodeInterface $code, Environment $env, array $context = []): string
    {
        assert($code instanceof TwigEventString);

        $parameters = array_replace_recursive($context, $code->getParameters());

        return $env->render($code->getTemplateString(), $parameters);
    }
}
