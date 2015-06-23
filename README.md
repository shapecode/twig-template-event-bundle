Shapecode - Twig Template Event Bundle
=======================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/141b4c63-8fdc-478e-9404-d0787b96d830/big.png)](https://insight.sensiolabs.com/projects/141b4c63-8fdc-478e-9404-d0787b96d830)

Give you the possibility to add code in a twig template dynamically.

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
            - { name: kernel.event_listener, event: twig.template.event, method: onTemplateEvent }
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
            $event->addCode(new TwigEventString('hello {{ world }}', array(
                'world' => 'World'
            )));
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
