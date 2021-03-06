<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\RenderHandler;

final class TwigEventRender extends TwigEventCode
{
    /** @var string */
    private $controller;

    /** @var array<string, mixed> */
    private $attributes;

    /** @var array<string, mixed> */
    private $query;

    /** @var string */
    private $strategy;

    /**
     * @param array<string, mixed> $attributes
     * @param array<string, mixed> $query
     */
    public function __construct(
        string $controller,
        array $attributes = [],
        int $priority = 0,
        array $query = [],
        string $strategy = 'inline'
    ) {
        parent::__construct($priority);

        $this->controller = $controller;
        $this->attributes = $attributes;
        $this->query      = $query;
        $this->strategy   = $strategy;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array<string, mixed> $attributes
     */
    public function setAttributes(array $attributes = []): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return array<string, mixed>
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @param array<string, mixed> $query
     */
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
