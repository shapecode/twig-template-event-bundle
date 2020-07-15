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
    public const DEPRECATED     = 'twig.template.event';
    public const PREFIX         = 'shapecode.twig_template';
    public const TEMPLATE_EVENT = 'shapecode.twig_template.event';

    /** @var Environment */
    protected $environment;

    /** @var array<string, mixed> */
    protected $parameters;

    /** @var array<string, mixed> */
    protected $context;

    /** @var string */
    protected $eventName;

    /** @var RequestStack */
    protected $request;

    /** @var TwigEventCodeInterface[] */
    protected $codes;

    /**
     * @param array<string, mixed> $context
     * @param array<string, mixed> $parameters
     */
    public function __construct(
        string $eventName,
        Environment $environment,
        array $context,
        array $parameters,
        RequestStack $request
    ) {
        $this->eventName   = $eventName;
        $this->environment = $environment;
        $this->context     = $context;
        $this->parameters  = $parameters;
        $this->request     = $request;
        $this->codes       = [];
    }

    public function getEnvironment(): Environment
    {
        return $this->environment;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return array<string, mixed>
     */
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

    /**
     * @return TwigEventCodeInterface[]
     */
    public function getCodes(): array
    {
        return $this->codes;
    }
}
