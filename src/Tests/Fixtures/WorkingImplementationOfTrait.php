<?php

namespace Thruster\Bundle\DataMapperBundle\Tests\Fixtures;

use Thruster\Bundle\DataMapperBundle\DataMapperAwareTrait;

/**
 * Class WorkingImplementationOfTrait
 *
 * @package Thruster\Bundle\DataMapperBundle\Tests\Fixtures
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class WorkingImplementationOfTrait
{
    use DataMapperAwareTrait;

    public $container;
}
