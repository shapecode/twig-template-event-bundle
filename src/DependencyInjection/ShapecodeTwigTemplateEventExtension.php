<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

final class ShapecodeTwigTemplateEventExtension extends Extension
{
    /** @inheritdoc */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $fileLocator = new FileLocator(__DIR__ . '/../Resources/config');
        $loader      = new PhpFileLoader($container, $fileLocator);
        $loader->load('services.php');
    }
}
