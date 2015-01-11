<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigEvents;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Shapecode\Bundle\TwigTemplateEventBundle\Twig\Tag\TemplateEventTokenParser;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class EventExtension
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Twig
 * @author Nikita Loges
 * @date 10.01.2015
 */
class EventExtension extends \Twig_Extension
{

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var RequestStack
     */
    protected $request;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher, \Twig_Environment $twig, RequestStack $request)
    {
        $this->dispatcher = $dispatcher;
        $this->twig = $twig;
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(
            // new TemplateEventTokenParser($this->dispatcher)
        );
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('event', array($this, 'event'), array('is_safe' => array('html'))),
        );
    }

    /**
     * @param $name
     * @return string
     */
    public function event($name) {
        $event = new TwigTemplateEvent($name, $this->request);
        $this->dispatcher->dispatch(TwigEvents::TEMPLATE_EVENT, $event);

        $codes = $event->getCodes();

        $compiled = '';

        if (count($codes)) {
            foreach ($codes as $code) {
                $compiled .= $this->twig->render($code);
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