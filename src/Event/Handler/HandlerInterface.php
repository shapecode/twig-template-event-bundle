<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Twig\Environment;

/** @template T of TwigEventCodeInterface */
#[AutoconfigureTag('shapecode_twig_template_event.handler')]
interface HandlerInterface
{
    /**
     * @param T                    $code
     * @param array<string, mixed> $context
     */
    public function handle(
        TwigEventCodeInterface $code,
        Environment $env,
        array $context = [],
    ): string;
}
