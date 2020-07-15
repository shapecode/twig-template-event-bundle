Shapecode - Twig Template Event Bundle
=======================

[![paypal](https://img.shields.io/badge/Donate-Paypal-blue.svg)](http://paypal.me/nloges)

[![PHP Version](https://img.shields.io/packagist/php-v/shapecode/twig-template-event-bundle.svg)](https://packagist.org/packages/shapecode/twig-template-event-bundle)
[![Latest Stable Version](https://img.shields.io/packagist/v/shapecode/twig-template-event-bundle.svg?label=stable)](https://packagist.org/packages/shapecode/twig-template-event-bundle)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/shapecode/twig-template-event-bundle.svg?label=unstable)](https://packagist.org/packages/shapecode/twig-template-event-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/shapecode/twig-template-event-bundle.svg)](https://packagist.org/packages/shapecode/twig-template-event-bundle)
[![Monthly Downloads](https://img.shields.io/packagist/dm/shapecode/twig-template-event-bundle.svg)](https://packagist.org/packages/shapecode/twig-template-event-bundle)
[![Daily Downloads](https://img.shields.io/packagist/dd/shapecode/twig-template-event-bundle.svg)](https://packagist.org/packages/shapecode/twig-template-event-bundle)
[![License](https://img.shields.io/packagist/l/shapecode/twig-template-event-bundle.svg)](https://packagist.org/packages/shapecode/twig-template-event-bundle)


Give you the possibility to add code in a twig template dynamically.

Install instructions
--------------------------------

First you need to add `shapecode/twig-template-event-bundle` to `composer.json`:

``` json
{
   "require": {
        "shapecode/twig-template-event-bundle": "~3.0"
    }
}
```

Please note that `dev-master` points to the latest release. If you want to use the latest development version please use `dev-develop`. Of course you can also use an explicit version number, e.g., `1.0.*`.

You have to add `ShapecodeTwigTemplateEventBundle` to your `AppKernel.php`:
And if you didn't do it already you also have to add `ShapecodeTwigStringLoaderBundle` to your `AppKernel.php`:

``` php
<?php
// app/AppKernel.php
//...
class AppKernel extends Kernel
{
    //...
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Shapecode\Bundle\TwigStringLoaderBundle\ShapecodeTwigStringLoaderBundle(),
            new Shapecode\Bundle\TwigTemplateEventBundle\ShapecodeTwigTemplateEventBundle(),
        );
        //...

        return $bundles;
    }
    //...
}
```

Now you can set events in twig templates:

``` twig
{{ event('test') }}
```

And listen to them with an event listener:

``` 
// services.yml
parameters:
    shapecode.twig_template_event.event.test.class: Shapecode\Bundle\TwigTemplateEventBundle\EventListener\TestTwigEventListener

services:
    # twig events
    shapecode.twig_template_event.event.test:
        class: %shapecode.twig_template_event.event.test.class%
        tags:
            - { name: kernel.event_listener, event: shapecode.twig_template.event, method: onTemplateEvent }
```

``` php
<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\EventListener;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventString;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;

/**
 * Class TestTwigEventListener
 * @package Shapecode\Bundle\TwigTemplateEventBundle\EventListener
 * @author Nikita Loges
 */
class TestTwigEventListener
{

    /**
     * @param TwigTemplateEvent $event
     */
    public function onTemplateEvent(TwigTemplateEvent $event)
    {
        if ($event->getEventName() == 'test') {
            $event->addCode(new TwigEventString('hello {{ world }}', array(
                'world' => 'World'
            )));
        }
    }
}
```
