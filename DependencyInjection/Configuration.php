<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Shapecode\Bundle\TwigTemplateEventBundle\DependencyInjection
 * @author Nikita Loges
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('shapecode_twig_template_event');

        return $treeBuilder;
    }
}
