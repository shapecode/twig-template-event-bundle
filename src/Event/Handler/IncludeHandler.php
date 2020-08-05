<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventInclude;
use Twig\Environment;

use function array_replace_recursive;
use function assert;

final class IncludeHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(
        TwigEventCodeInterface $code,
        Environment $env,
        array $context = []
    ): string {
        assert($code instanceof TwigEventInclude);

        $parameters = array_replace_recursive($context, $code->getParameters());
        $template   = $env->resolveTemplate($code->getTemplate());

        return $template->render($parameters);
    }
}
