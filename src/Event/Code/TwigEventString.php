<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Code;

use LogicException;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\StringHandler;
use Shapecode\Twig\Loader\StringLoader;

use function class_exists;
use function sprintf;

final class TwigEventString extends TwigEventCode
{
    /** @param array<string, mixed> $parameters */
    public function __construct(private string $templateString, private array $parameters = [], int $priority = 0)
    {
        if (! class_exists(StringLoader::class)) {
            throw new LogicException(sprintf(
                'You have to install %s or %s package to use %s',
                'shapecode/twig-string-loader-bundle',
                'shapecode/twig-string-loader',
                self::class,
            ));
        }

        parent::__construct($priority);
    }

    public function getTemplateString(): string
    {
        return $this->templateString;
    }

    public function setTemplateString(string $templateString): void
    {
        $this->templateString = $templateString;
    }

    /** @return array<string, mixed> */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /** @param array<string, mixed> $parameters */
    public function setParameters(array $parameters = []): void
    {
        $this->parameters = $parameters;
    }

    public function getHandlerName(): string
    {
        return StringHandler::class;
    }
}
