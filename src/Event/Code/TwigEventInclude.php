<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

class TwigEventInclude extends TwigEventCode
{
    /** @var string */
    protected $template;

    /** @var array<string, mixed> */
    protected $parameters;

    /**
     * @param array<string, mixed> $parameters
     */
    public function __construct(string $templateString, array $parameters = [], int $priority = 0)
    {
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
        return 'shapecode_twig_template_event.event_handler.include';
    }
}
