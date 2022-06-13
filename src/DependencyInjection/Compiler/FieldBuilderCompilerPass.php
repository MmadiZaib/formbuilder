<?php

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FieldBuilderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $mapping = [];

        foreach ($container->findTaggedServiceIds('form_builder.builder') as $id => $tags) {
            $service = new Reference($id);

            foreach ($tags as $tag) {
                if (!isset($tag['type'])) {
                    throw new \Exception('form_builder.builder tags require a "type"');
                }

                $mapping[$tag['type']] = $service;
            }
        }

        $registryDefinition = $container->getDefinition('form_builder.builder_registry');
        $registryDefinition->replaceArgument(1, $mapping);
    }
}