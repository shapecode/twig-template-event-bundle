<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Services;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

/**
 * Class EventService
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Services
 * @author  Nikita Loges
 */
class EventService implements EventServiceInterface
{

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /** @var RequestStack */
    protected $requestStack;

    /** @var HandlerManagerInterface */
    protected $manager;

    /**
     * @param EventDispatcherInterface $dispatcher
     * @param RequestStack             $requestStack
     * @param HandlerManagerInterface  $manager
     */
    public function __construct(EventDispatcherInterface $dispatcher, RequestStack $requestStack, HandlerManagerInterface $manager)
    {
        $this->dispatcher = $dispatcher;
        $this->requestStack = $requestStack;
        $this->manager = $manager;
    }

    /**
     * @inheritdoc
     */
    public function handleEvent($name, Environment $environment, array $parameters = [], array $context = [])
    {
        $event = new TwigTemplateEvent($name, $environment, $context, $parameters, $this->requestStack);

        $this->dispatcher->dispatch(TwigTemplateEvent::DEPRECATED, $event);
        $this->dispatcher->dispatch(TwigTemplateEvent::TEMPLATE_EVENT, $event);
        $this->dispatcher->dispatch(TwigTemplateEvent::PREFIX . '.' . $name, $event);

        return $this->render($event);
    }

    /**
     * @param TwigTemplateEvent $event
     *
     * @return string
     */
    protected function render(TwigTemplateEvent $event)
    {
        $codes = $event->getCodes();

        usort($codes, function (TwigEventCodeInterface $a, TwigEventCodeInterface $b) {
            if ($a->getPriority() == $b->getPriority()) {
                return 0;
            }

            return ($a->getPriority() < $b->getPriority()) ? -1 : 1;
        });

        $compiled = [];

        if (count($codes)) {
            foreach ($codes as $code) {
                $compiled[] = $this->manager->getHandler($code->getHandlerName())->handle($code, $event->getEnvironment(), $event->getContext());
            }
        }

        return implode('', $compiled);
    }
}
