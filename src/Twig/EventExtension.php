<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig;

use Shapecode\Bundle\TwigTemplateEventBundle\Services\EventServiceInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;

/**
 * Class EventExtension
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Twig
 * @author  Nikita Loges
 */
class EventExtension extends AbstractExtension
{

    /** @var EventServiceInterface */
    protected $eventService;

    /**
     * @param EventServiceInterface $eventService
     */
    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('event', [$this, 'event'], [
                'needs_environment' => true,
                'needs_context'     => true,
                'is_safe'           => ['all']
            ]),
        ];
    }

    /**
     * @param Environment       $environment
     * @param                   $context
     * @param                   $name
     * @param array             $parameters
     *
     * @return string
     */
    public function event(Environment $environment, $context, $name, array $parameters = [])
    {
        return $this->eventService->handleEvent($name, $environment, $parameters, $context);
    }
}
