Shapecode - Twig Template Event Bundle
=======================

Give you the possibility to add code in a twig template dynamically.

System requirements
-----------------------------------

* PHP >=5.3
* Twig ~1.16
* Shapecode Twig String Loader ~1.0
* Symfony Event Dispatcher Bundle ~2.6

Install instructions
--------------------------------

First you need to add `shapecode/twig-template-event-bundle` to `composer.json`:

``` json
{
   "require": {
        "shapecode/twig-template-event-bundle": "~1.0"
    }
}
```

Please note that `dev-master` points to the latest release. If you want to use the latest development version please use `dev-develop`. Of course you can also use an explicit version number, e.g., `1.0.*`.

You have to add `ShapecodeTwigTemplateEventBundle` to your `AppKernel.php`:
And if you didn't do it already you also have to add `ShapecodeTwigStringLoaderBundle` to your `AppKernel.php`:

``` php
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
            - { name: kernel.event_listener, event: twig.template.event, method: onTemplateEvent }
```

``` php
<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\EventListener;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;

/**
 * Class TestTwigEventListener
 * @package Shapecode\Bundle\TwigTemplateEventBundle\EventListener
 * @author Nikita Loges
 * @date 10.01.2015
 */
class TestTwigEventListener
{

    /**
     * @param TwigTemplateEvent $event
     */
    public function onTemplateEvent(TwigTemplateEvent $event)
    {
        if ($event->getEventName() == 'test') {
            $event->addCode('hello world');
        }
    }
}
```

Update instructions
---------------------------

Do a [composer](https://getcomposer.org/doc/00-intro.md) update.

```bash
php composer.phar update
```