<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Manager;

use RuntimeException;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
use Symfony\Contracts\Service\ServiceProviderInterface;

use function sprintf;

final readonly class HandlerManager
{
    /** @param ServiceProviderInterface<HandlerInterface<TwigEventCodeInterface>> $handlers */
    public function __construct(
        #[AutowireLocator('shapecode_twig_template_event.handler')]
        private ServiceProviderInterface $handlers,
    ) {
    }

    /** @return HandlerInterface<TwigEventCodeInterface> */
    public function getHandler(string $name): HandlerInterface
    {
        if (! $this->handlers->has($name)) {
            throw new RuntimeException(sprintf('handler %s not found', $name), 1596984726680);
        }

        return $this->handlers->get($name);
    }
}
