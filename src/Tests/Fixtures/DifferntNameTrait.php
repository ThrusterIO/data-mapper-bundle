<?php

namespace Thruster\Bundle\DataMapperBundle\Tests\Fixtures;

use Thruster\Bundle\DataMapperBundle\DataMapperAwareTrait;

/**
 * Class DifferntNameTrait
 *
 * @package Thruster\Bundle\DataMapperBundle\Tests\Fixtures
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class DifferntNameTrait
{
    use DataMapperAwareTrait;

    public $containeris;

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->containeris;
    }
}
