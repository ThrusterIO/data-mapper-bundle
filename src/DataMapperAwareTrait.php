<?php

namespace Thruster\Bundle\DataMapperBundle;

/**
 * Trait DataMapperAwareTrait
 *
 * @package Thruster\Bundle\DataMapperBundle
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
trait DataMapperAwareTrait
{
    public function getDataMapper($name)
    {
        if (property_exists($this, 'container')) {
            return $this->container->get('thruster_data_mappers')->getMapper($name);
        } elseif (method_exists($this, 'getContainer')) {
            return $this->getContainer()->get('thruster_data_mappers')->getMapper($name);
        }

        throw new \LogicException(
            'DataMapperAwareTrait require Symfony Container accessible via property' .
            '$container or ->getContainer() method'
        );
    }
}
