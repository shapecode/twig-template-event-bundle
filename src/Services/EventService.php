<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Services;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

use function count;
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

        $this->dispatcher->dispatch($event, TwigTemplateEvent::DEPRECATED);
        $this->dispatcher->dispatch($event, TwigTemplateEvent::TEMPLATE_EVENT);
        $this->dispatcher->dispatch($event, TwigTemplateEvent::PREFIX . '.' . $name);

        return $this->render($event);
    }

    protected function render(TwigTemplateEvent $event): string
    {
        $codes = $event->getCodes();

        usort($codes, static function (TwigEventCodeInterface $a, TwigEventCodeInterface $b): int {
            return $a->getPriority() <=> $b->getPriority();
        });

        $compiled = [];

        if (count($codes) > 0) {
            foreach ($codes as $code) {
                $compiled[] = $this->manager->getHandler($code->getHandlerName())->handle($code, $event->getEnvironment(), $event->getContext());
            }
        }

        return implode('', $compiled);
    }
}
