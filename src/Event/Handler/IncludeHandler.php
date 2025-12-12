<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventInclude;
use Twig\Environment;

use function array_replace_recursive;

/** @template-implements HandlerInterface<TwigEventInclude> */
final readonly class IncludeHandler implements HandlerInterface
{
    /** @inheritDoc */
    public function handle(
        TwigEventCodeInterface $code,
        Environment $env,
        array $context = [],
    ): string {
        $parameters = array_replace_recursive($context, $code->getParameters());

        return $env->resolveTemplate($code->getTemplate())->render($parameters);
    }
}
