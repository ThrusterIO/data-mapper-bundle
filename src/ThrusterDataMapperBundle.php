<?php

namespace Thruster\Bundle\DataMapperBundle;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ThrusterDataMapperBundle
 *
 * @package Thruster\Bundle\DataMapperBundle
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ThrusterDataMapperBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new class implements CompilerPassInterface {
                /**
                 * @inheritDoc
                 */
                public function process(ContainerBuilder $container)
                {
                    $dataMappersId = 'thruster_data_mappers';
                    $dataMappersDefinition = new Definition('Thruster\Component\DataMapper\DataMappers');

                    $container->setDefinition($dataMappersId, $dataMappersDefinition);

                    foreach ($container->findTaggedServiceIds('thruster_data_mapper') as $id => $tags) {
                        $dataMappersDefinition->addMethodCall('addMapper', [new Reference($id)]);
                    }
                }
            }
        );
    }

}
