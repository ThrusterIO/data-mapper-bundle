<?php

namespace Thruster\Bundle\DataMapperBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
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
            new CompilerPass()
        );
    }
}
