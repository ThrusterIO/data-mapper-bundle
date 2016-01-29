<?php

namespace Thruster\Bundle\DataMapperBundle\Tests;

use Thruster\Bundle\DataMapperBundle\Tests\Fixtures\DataMapperMock;
use Thruster\Bundle\DataMapperBundle\ThrusterDataMapperBundle;

/**
 * Class ThrusterDataMapperBundleTest
 *
 * @package Thruster\Bundle\DataMapperBundle\Tests
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ThrusterDataMapperBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testAddCompilerPass()
    {
        $builderMock = $this->getMockBuilder('\Symfony\Component\DependencyInjection\ContainerBuilder')
            ->setMethods(['addCompilerPass', 'setDefinition', 'getDefinition', 'findTaggedServiceIds'])
            ->getMock();

        $builderMock->expects($this->once())
            ->method('addCompilerPass')
            ->will(
                $this->returnCallback(
                    function ($compilerPass) use ($builderMock) {
                        $this->assertInstanceOf(
                            '\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface',
                            $compilerPass
                        );

                        $compilerPass->process($builderMock);
                    }
                )
            );

        $builderMock->expects($this->once())
            ->method('setDefinition')
            ->will(
                $this->returnCallback(
                    function ($id, $definition) {
                        $this->assertSame('thruster_data_mappers', $id);
                        $this->assertInstanceOf(
                            '\Symfony\Component\DependencyInjection\Definition',
                            $definition
                        );
                        $this->assertSame('Thruster\Component\DataMapper\DataMappers', $definition->getClass());
                    }
                )
            );

        $builderMock->expects($this->once())
            ->method('getDefinition')
            ->will(
                $this->returnCallback(
                    function ($id) {
                        $this->assertSame('foo_bar', $id);

                        $classDef = new DataMapperMock();

                        $mock = $this->getMock('\Symfony\Component\DependencyInjection\Definition');
                        $mock->expects($this->once())
                            ->method('getClass')
                            ->willReturn($classDef);

                        return $mock;
                    }
                )
            );

        $builderMock->expects($this->once())
            ->method('findTaggedServiceIds')
            ->will(
                $this->returnCallback(
                    function ($tagName) {
                        $this->assertSame('thruster_data_mapper', $tagName);

                        return [
                            'foo_bar' => [[]],
                        ];
                    }
                )
            );

        $bundle = new ThrusterDataMapperBundle();
        $bundle->build($builderMock);
    }
}
