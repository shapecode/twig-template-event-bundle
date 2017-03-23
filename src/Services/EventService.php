<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Services;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class EventService
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Services
 * @author  Nikita Loges
 */
class EventService implements EventServiceInterface
{

    /** @var ContainerInterface */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function handleEvent($name, array $parameters = [], array $context = [])
    {
        $dispatcher = $this->container->get('event_dispatcher');
        $requestStack = $this->container->get('request_stack');

        $event = new TwigTemplateEvent($name, $context, $parameters, $requestStack);

        $dispatcher->dispatch(TwigTemplateEvent::DEPRECATED, $event);
        $dispatcher->dispatch(TwigTemplateEvent::TEMPLATE_EVENT, $event);
        $dispatcher->dispatch(TwigTemplateEvent::PREFIX . '.' . $name, $event);

        return $this->render($context, $event);
    }

    /**
     * @param                   $context
     * @param TwigTemplateEvent $event
     *
     * @return string
     */
    protected function render($context, TwigTemplateEvent $event)
    {
        $twig = $this->container->get('twig');

        $codes = $event->getCodes();
        usort($codes, function (TwigEventCodeInterface $a, TwigEventCodeInterface $b) {
            if ($a->getPriority() == $b->getPriority()) {
                return 0;
            }

            return ($a->getPriority() < $b->getPriority()) ? -1 : 1;
        });

        $compiled = '';

        if (count($codes)) {
            foreach ($codes as $code) {
                $compiled .= $this->container->get($code->getHandlerName())->handle($code, $twig, $context);
            }
        }

        return $compiled;
    }
}
