<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig;

use Shapecode\Bundle\TwigTemplateEventBundle\Services\EventServiceInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class EventExtension extends AbstractExtension
{
    /** @var EventServiceInterface */
    private $eventService;

    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * @inheritDoc
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('event', [
                $this,
                'event',
            ], [
                'needs_environment' => true,
                'needs_context'     => true,
                'is_safe'           => ['all'],
            ]),
        ];
    }

    /**
     * @param array<string, mixed> $context
     * @param array<string, mixed> $parameters
     */
    public function event(Environment $environment, array $context, string $name, array $parameters = []): string
    {
        return $this->eventService->handleEvent($name, $environment, $parameters, $context);
    }
}
