<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection\Compiler;

use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManagerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class EventHandlerCompiler implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        $manager = $container->findDefinition(HandlerManagerInterface::class);
        $tags    = $container->findTaggedServiceIds('shapecode_twig_template_event.handler');

        foreach ($tags as $id => $config) {
            $manager->addMethodCall('addHandler', [new Reference($id)]);
        }
    }
}
