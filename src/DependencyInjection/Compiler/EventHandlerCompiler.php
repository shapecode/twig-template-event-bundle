<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManager;

final class EventHandlerCompiler implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        $manager = $container->getDefinition(HandlerManager::class);
        $tags    = $container->findTaggedServiceIds('shapecode_twig_template_event.handler');

        foreach ($tags as $id => $config) {
            $manager->addMethodCall('addHandler', [new Reference($id)]);
        }
    }
}
