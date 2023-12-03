<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class ShapecodeTwigTemplateEventExtension extends Extension
{
    /** @inheritdoc */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container
            ->registerForAutoconfiguration(HandlerInterface::class)
            ->addTag('shapecode_twig_template_event.handler');
    }
}
