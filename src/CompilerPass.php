<?php

namespace Thruster\Bundle\DataMapperBundle;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class CompilerPass
 *
 * @package Thruster\Bundle\DataMapperBundle
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class CompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $dataMappersId         = 'thruster_data_mappers';
        $dataMappersDefinition = new Definition('Thruster\Component\DataMapper\DataMappers');

        $container->setDefinition($dataMappersId, $dataMappersDefinition);

        foreach ($container->findTaggedServiceIds('thruster_data_mapper') as $id => $tags) {
            $dataMappersDefinition->addMethodCall('addMapper', [new Reference($id)]);
        }
    }
}
