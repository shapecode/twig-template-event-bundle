<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig\Tag;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigEvents;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Twig_Node;
use Twig_Node_Expression;
use Twig_Compiler;
use Twig_NodeOutputInterface;

/**
 * Class TemplateEventNode
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Twig\Tag
 * @author Nikita Loges
 * @date 10.01.2015
 */
class TemplateEventNode extends Twig_Node
{

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * {@inheritdoc}
     */
    public function __construct($name, EventDispatcherInterface $dispatcher, $line, $tag = null)
    {
        parent::__construct(array('name' => $name), array(), $line, $tag);

        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $eventName = $this->getNode('name')->getAttribute('value');

        $event = new TwigTemplateEvent($eventName);
        $this->dispatcher->dispatch(TwigEvents::TEMPLATE_EVENT, $event);

        $codes = $event->getCodes();

        if (count($codes)) {
            foreach ($codes as $code) {
                $compiler->write('$templateInjection = "' . $code . '";');
                $compiler->write('echo $this->env->render($templateInjection);');
            }
        }
    }
}