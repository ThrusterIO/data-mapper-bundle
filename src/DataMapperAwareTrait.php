<?php

namespace Thruster\Bundle\DataMapperBundle;

use Thruster\Component\DataMapper\DataMapper;

/**
 * Trait DataMapperAwareTrait
 *
 * @package Thruster\Bundle\DataMapperBundle
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
trait DataMapperAwareTrait
{
    /**
     * @param string $class
     *
     * @return DataMapper
     */
    public function getDataMapper($class)
    {
        if (property_exists($this, 'container')) {
            return $this->container->get('thruster_data_mappers')->getMapper($class);
        } elseif (method_exists($this, 'getContainer')) {
            return $this->getContainer()->get('thruster_data_mappers')->getMapper($class);
        }

        throw new \LogicException(
            'DataMapperAwareTrait require Symfony Container accessible via property' .
            '$container or ->getContainer() method'
        );
    }
}
