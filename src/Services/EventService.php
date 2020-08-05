<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Services;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

use function array_map;
use function implode;
use function usort;

class EventService implements EventServiceInterface
{
    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /** @var RequestStack */
    protected $requestStack;

    /** @var HandlerManagerInterface */
    protected $manager;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        RequestStack $requestStack,
        HandlerManagerInterface $manager
    ) {
        $this->dispatcher   = $dispatcher;
        $this->requestStack = $requestStack;
        $this->manager      = $manager;
    }

    /**
     * @inheritdoc
     */
    public function handleEvent(string $name, Environment $environment, array $parameters = [], array $context = []): string
    {
        $event = new TwigTemplateEvent($name, $environment, $context, $parameters, $this->requestStack);

        $this->dispatcher->dispatch($event);

        return $this->render($event);
    }

    protected function render(TwigTemplateEvent $event): string
    {
        return implode('', $this->compile(
            $event,
            ...$this->sort(...$event->getCodes())
        ));
    }

    /**
     * @return TwigEventCodeInterface[]
     */
    protected function sort(TwigEventCodeInterface ...$codes): array
    {
        usort($codes, static function (TwigEventCodeInterface $a, TwigEventCodeInterface $b): int {
            return $a->getPriority() <=> $b->getPriority();
        });

        return $codes;
    }

    /**
     * @return string[]
     */
    protected function compile(TwigTemplateEvent $event, TwigEventCodeInterface ...$codes): array
    {
        return array_map(function (TwigEventCodeInterface $code) use ($event): string {
            return $this->manager->getHandler($code->getHandlerName())->handle($code, $event->getEnvironment(), $event->getContext());
        }, $codes);
    }
}
