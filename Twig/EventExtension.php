<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventInclude;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventRender;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventString;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigEvents;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;

/**
 * Class EventExtension
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Twig
 * @author Nikita Loges
 * @date 10.01.2015
 */
class EventExtension extends \Twig_Extension
{

    /** @var FragmentHandler */
    private $fragment;

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /** @var RequestStack */
    protected $request;

    /**
     * @param FragmentHandler $fragment
     * @param EventDispatcherInterface $dispatcher
     * @param RequestStack $request
     */
    public function __construct(FragmentHandler $fragment, EventDispatcherInterface $dispatcher, RequestStack $request)
    {
        $this->fragment = $fragment;
        $this->dispatcher = $dispatcher;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('event', array($this, 'event'), array(
                'needs_environment' => true,
                'needs_context' => true,
                'is_safe' => array('all')
            )),
        );
    }

    /**
     * @param \Twig_Environment $env
     * @param $context
     * @param $name
     * @param array $parameters
     * @return string
     */
    public function event(\Twig_Environment $env, $context, $name, array $parameters = array())
    {

        $event = new TwigTemplateEvent($name, $parameters, $this->request);
        $this->dispatcher->dispatch(TwigEvents::TEMPLATE_EVENT, $event);

        return $this->render($env, $context, $event);
    }

    /**
     * @param \Twig_Environment $env
     * @param $context
     * @param TwigTemplateEvent $event
     * @return string
     */
    protected function render(\Twig_Environment $env, $context, TwigTemplateEvent $event)
    {
        $codes = $event->getCodes();
        $compiled = '';

        if (count($codes)) {
            foreach ($codes as $code) {

                if ($code instanceof TwigEventInclude) {
                    $compiled .= $env->resolveTemplate($code->getTemplate())->render(array_replace_recursive($context, $code->getParameters()));
                    continue;
                }
                if ($code instanceof TwigEventString) {
                    $compiled .= $env->render($code->getTemplateString(), array_replace_recursive($context, $code->getParameters()));
                    continue;
                }

                if ($code instanceof TwigEventRender) {
                    $reference = new ControllerReference($code->getController(), $code->getAttributes(), $code->getQuery());
                    $compiled .= $this->fragment->render($reference, $code->getStrategy());
                    continue;
                }
            }
        }

        return $compiled;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'shapecode_twig_events';
    }
}
