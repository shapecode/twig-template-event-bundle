<?php

declare(strict_types=1);

use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManager;
use Shapecode\Bundle\TwigTemplateEventBundle\Services\EventService;
use Shapecode\Bundle\TwigTemplateEventBundle\Twig\EventExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load(
        'Shapecode\\Bundle\\TwigTemplateEventBundle\\Event\\Handler\\',
        __DIR__ . '/../../Event/Handler',
    );

    $services->set(EventService::class);
    $services->set(EventExtension::class);
    $services->set(HandlerManager::class);
};
