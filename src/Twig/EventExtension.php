<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class EventExtension
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Twig
 * @author  Nikita Loges
 * @date    10.01.2015
 */
class EventExtension extends \Twig_Extension
{

    /** @var ContainerInterface */
    protected $container;

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /** @var RequestStack */
    protected $request;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->dispatcher = $container->get('event_dispatcher');
        $this->request = $container->get('request_stack');
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
     * @param \Twig_Environment $env
     * @param                   $context
     * @param                   $name
     * @param array             $parameters
     *
     * @return string
     */
    public function event(\Twig_Environment $env, $context, $name, array $parameters = [])
    {
        $event = new TwigTemplateEvent($name, $context, $parameters, $this->request);
        $this->dispatcher->dispatch(TwigTemplateEvent::TEMPLATE_EVENT, $event);
        $this->dispatcher->dispatch(TwigTemplateEvent::PREFIX . '.' . $name, $event);

        return $this->render($env, $context, $event);
    }

    /**
     * @param \Twig_Environment $env
     * @param                   $context
     * @param TwigTemplateEvent $event
     *
     * @return string
     */
    protected function render(\Twig_Environment $env, $context, TwigTemplateEvent $event)
    {
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
                $compiled .= $this->container->get($code->getHandlerName())->handle($code, $env, $context);
            }
        }

        return $compiled;
    }
}
