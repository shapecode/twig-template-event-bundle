<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class EventHandlerCompiler
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection\Compiler
 * @author  Nikita Loges
 */
class EventHandlerCompiler implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $manager = $container->getDefinition('shapecode_twig_template_event.handler_manager');
        $tags = $container->findTaggedServiceIds('shapecode_twig_template_event.handler');

        foreach ($tags as $id => $config) {
            $manager->addMethodCall('addHandler', [$id, new Reference($id)]);
        }
    }

}
