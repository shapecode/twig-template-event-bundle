<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig;

use Shapecode\Bundle\TwigTemplateEventBundle\Services\EventServiceInterface;

/**
 * Class EventExtension
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Twig
 * @author  Nikita Loges
 */
class EventExtension extends \Twig_Extension
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
                'needs_context' => true,
                'is_safe'       => ['all']
            ]),
        ];
    }

    /**
     * @param                   $context
     * @param                   $name
     * @param array             $parameters
     *
     * @return string
     */
    public function event($context, $name, array $parameters = [])
    {
        return $this->eventService->handleEvent($name, $parameters, $context);
    }
}
