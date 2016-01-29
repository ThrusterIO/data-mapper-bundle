<?php

namespace Thruster\Bundle\DataMapperBundle\Tests;

use Thruster\Bundle\DataMapperBundle\DataMapperAwareTrait;
use Thruster\Bundle\DataMapperBundle\Tests\Fixtures\DifferntNameTrait;
use Thruster\Bundle\DataMapperBundle\Tests\Fixtures\InvalidUseOfTrait;
use Thruster\Bundle\DataMapperBundle\Tests\Fixtures\WorkingImplementationOfTrait;

/**
 * Class DataMapperAwareTraitTest
 *
 * @package Thruster\Bundle\DataMapperBundle\Tests
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class DataMapperAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testTraitWithProperty()
    {
        $class = new WorkingImplementationOfTrait();

        $input = $this->getMockBuilder('\Thruster\Component\DataMapper\DataMapper')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $dataMappers = $this->getMock('\Thruster\Component\DataMapper\DataMappers');

        $dataMappers->expects($this->once())
            ->method('getMapper')
            ->with('foo_bar')
            ->willReturn($input);

        $container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('get')
            ->with('thruster_data_mappers')
            ->willReturn($dataMappers);

        $class->container = $container;

        $this->assertEquals($input, $class->getDataMapper('foo_bar'));
    }

    public function testTraitWithMethod()
    {
        $class = new DifferntNameTrait();

        $input = $this->getMockBuilder('\Thruster\Component\DataMapper\DataMapper')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $dataMappers = $this->getMock('\Thruster\Component\DataMapper\DataMappers');

        $dataMappers->expects($this->once())
            ->method('getMapper')
            ->with('foo_bar')
            ->willReturn($input);

        $container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('get')
            ->with('thruster_data_mappers')
            ->willReturn($dataMappers);

        $class->containeris = $container;

        $this->assertEquals($input, $class->getDataMapper('foo_bar'));
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage DataMapperAwareTrait require Symfony Container accessible via property$container or ->getContainer() method
     */
    public function testTraitWithException()
    {
        $class = new InvalidUseOfTrait();

        $class->getDataMapper('foo_bar');
    }
}
