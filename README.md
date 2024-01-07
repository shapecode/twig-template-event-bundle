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
```bash
composer require shapecode/twig-template-event-bundle
```
... or ...
```json
{
   "require": {
        "shapecode/twig-template-event-bundle": "~5.0"
    }
}
```

If you dont use Symfony Flex you have to add `ShapecodeTwigTemplateEventBundle` to your `bundles.php`:

```php
<?php
// config/bundles.php

return [
    // ...
    Shapecode\Bundle\TwigTemplateEventBundle\ShapecodeTwigTemplateEventBundle::class => ['all' => true],
];
```

Now you can set events in twig templates:

```twig
{{ event('test') }}
```

And listen to them with an event listener:

```yaml
services:
    # twig events
    Shapecode\Bundle\TwigTemplateEventBundle\EventListener\TestTwigEventListener: ~
```

```php
<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\EventListener;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventString;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventInclude;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class TestTwigEventListener
{
    public function __invoke(TwigTemplateEvent $event): void
    {
        if ($event->getEventName() == 'foo') {
        
            // to add a string
            $event->addCode(
                new TwigEventString(
                    'hello {{ world }}', 
                    [
                        'world' => 'World'
                    ],
                    10 // default is 0. The higher the number the later the code will be executed. The lower the number the earlier the code will be executed.
                )
            );
        }
        
        if ($event->getEventName() == 'bar') {
        
            // to include a twig template
            $event->addCode(
                new TwigEventInclude(
                    '@App/Layout/Header/_search.html.twig', 
                    [
                        'world' => 'World'
                    ],
                )
            );
        }
    }
}
```
