<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\IncludeHandler;

final class TwigEventInclude extends TwigEventCode
{
    /** @var string */
    private $template;

    /** @var array<string, mixed> */
    private $parameters;

    /**
     * @param array<string, mixed> $parameters
     */
    public function __construct(
        string $templateString,
        array $parameters = [],
        int $priority = 0
    ) {
        parent::__construct($priority);

        $this->template   = $templateString;
        $this->parameters = $parameters;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): void
    {
        $this->template = $template;
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
        return IncludeHandler::class;
    }
}
