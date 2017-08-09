<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle;

use Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection\Compiler\EventHandlerCompiler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ShapecodeTwigTemplateEventBundle
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle
 * @author  Nikita Loges
 */
class ShapecodeTwigTemplateEventBundle extends Bundle
{

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new EventHandlerCompiler());
    }

}
