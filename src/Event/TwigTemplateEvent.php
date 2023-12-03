<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event;

use RuntimeException;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\EventDispatcher\Event;
use Twig\Environment;

class TwigTemplateEvent extends Event
{
    /** @var array<array-key, TwigEventCodeInterface> */
    private array $codes;

    /**
     * @param array<string, mixed> $context
     * @param array<string, mixed> $parameters
     */
    public function __construct(
        private string $eventName,
        private Environment $environment,
        private array $context,
        private array $parameters,
        private RequestStack $request,
    ) {
        $this->codes = [];
    }

    public function getEnvironment(): Environment
    {
        return $this->environment;
    }

    /** @return array<string, mixed> */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /** @return array<string, mixed> */
    public function getContext(): array
    {
        return $this->context;
    }

    public function getRequest(): Request
    {
        $request = $this->request->getCurrentRequest();

        if ($request === null) {
            throw new RuntimeException('request can not be null', 1594818314245);
        }

        return $request;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function addCode(TwigEventCodeInterface $code): void
    {
        $this->codes[] = $code;
    }

    /** @return TwigEventCodeInterface[] */
    public function getCodes(): array
    {
        return $this->codes;
    }
}
