<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\EventListener;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventString;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;

/**
 * Class TestTwigEventListener
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\EventListener
 * @author  Nikita Loges
 * @date    10.01.2015
 */
class TestTwigEventListener
{

    /**
     * @param TwigTemplateEvent $event
     */
    public function onTemplateEvent(TwigTemplateEvent $event)
    {
        if ($event->getEventName() == 'test') {
            $event->addCode(new TwigEventString('hello {{ world }}', [
                'world' => 'World'
            ]));
        }
    }
}
