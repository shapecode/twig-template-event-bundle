<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle;

use Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection\Compiler\EventHandlerCompiler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ShapecodeTwigTemplateEventBundle extends Bundle
{
    /** @inheritDoc */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new EventHandlerCompiler());
    }
}
