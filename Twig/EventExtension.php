<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig;

use Shapecode\Bundle\TwigTemplateEventBundle\Twig\Tag\TemplateEventTokenParser;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(
            new TemplateEventTokenParser($this->dispatcher)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'shapecode_twig_events';
    }
}