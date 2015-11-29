<?php

namespace Thruster\Bundle\DataMapperBundle\Tests;

use Thruster\Bundle\DataMapperBundle\DataMapperAwareTrait;

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
        $class = new class {
            use DataMapperAwareTrait;

            public $container;
        };

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
        $class = new class {
            use DataMapperAwareTrait;

            public $containeris;

            public function getContainer()
            {
                return $this->containeris;
            }
        };

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
        $class = new class {
            use DataMapperAwareTrait;
        };

        $class->getDataMapper('foo_bar');
    }
}
