<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Services;

use Twig\Environment;

interface EventServiceInterface
{
    /**
     * @param array<string, mixed> $parameters
     * @param array<string, mixed> $context
     */
    public function handleEvent(string $name, Environment $environment, array $parameters = [], array $context = []): string;
}
