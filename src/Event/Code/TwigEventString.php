<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\StringHandler;

final class TwigEventString extends TwigEventCode
{
    /** @var string */
    private $templateString;

    /** @var array<string, mixed> */
    private $parameters;

    /**
     * @param array<string, mixed> $parameters
     */
    public function __construct(string $templateString, array $parameters = [], int $priority = 0)
    {
        parent::__construct($priority);

        $this->templateString = $templateString;
        $this->parameters     = $parameters;
    }

    public function getTemplateString(): string
    {
        return $this->templateString;
    }

    public function setTemplateString(string $templateString): void
    {
        $this->templateString = $templateString;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function setParameters(array $parameters = []): void
    {
        $this->parameters = $parameters;
    }

    public function getHandlerName(): string
    {
        return StringHandler::class;
    }
}
