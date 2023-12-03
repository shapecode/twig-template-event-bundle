<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\RenderHandler;

final class TwigEventRender extends TwigEventCode
{
    /**
     * @param array<string, mixed> $attributes
     * @param array<string, mixed> $query
     */
    public function __construct(
        private string $controller,
        private array $attributes = [],
        int $priority = 0,
        private array $query = [],
        private string $strategy = 'inline',
    ) {
        parent::__construct($priority);
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /** @return array<string, mixed> */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /** @param array<string, mixed> $attributes */
    public function setAttributes(array $attributes = []): void
    {
        $this->attributes = $attributes;
    }

    /** @return array<string, mixed> */
    public function getQuery(): array
    {
        return $this->query;
    }

    /** @param array<string, mixed> $query */
    public function setQuery(array $query = []): void
    {
        $this->query = $query;
    }

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    public function setStrategy(string $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function getHandlerName(): string
    {
        return RenderHandler::class;
    }
}
